<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\HorarioDisponible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CitaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'doctor_id' => 'required|exists:doctors,id',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'mensaje' => 'nullable|string|max:1000',
        ]);

        $doctor = Doctor::findOrFail($request->doctor_id);

        // Verificar si el paciente está autenticado
        $pacienteId = null;
        if (Auth::check() && Auth::user()->isPaciente()) {
            $pacienteId = Auth::user()->paciente->id ?? null;
        }

        // Verificar que el horario esté disponible
        $fechaHora = Carbon::parse($request->fecha . ' ' . $request->hora);
        
        // Verificar si hay un horario disponible para este doctor
        $horarioDisponible = HorarioDisponible::where('doctor_id', $doctor->id)
            ->where('fecha', $request->fecha)
            ->where('hora_inicio', '<=', $fechaHora->format('H:i:s'))
            ->where('hora_fin', '>=', $fechaHora->format('H:i:s'))
            ->where('disponible', true)
            ->first();

        if (!$horarioDisponible) {
            return back()->withErrors(['hora' => 'Este horario no está disponible. Por favor seleccione otro.'])->withInput();
        }

        // Verificar que no haya otra cita en el mismo horario
        $citaExistente = Cita::where('doctor_id', $doctor->id)
            ->whereDate('fecha', $fechaHora->format('Y-m-d'))
            ->whereTime('hora', $fechaHora->format('H:i:s'))
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->exists();

        if ($citaExistente) {
            return back()->withErrors(['hora' => 'Esta hora ya está ocupada. Por favor seleccione otra.'])->withInput();
        }

        Cita::create([
            'doctor_id' => $doctor->id,
            'paciente_id' => $pacienteId,
            'nombre_paciente' => $request->nombre,
            'email_paciente' => $request->email,
            'telefono_paciente' => $request->telefono,
            'fecha' => $fechaHora->format('Y-m-d'),
            'hora' => $fechaHora->format('H:i:s'),
            'especialidad' => $doctor->especialidad,
            'estado' => 'pendiente',
            'comentarios' => $request->mensaje,
        ]);

        return redirect()->route('solicitar.cita')->with('success', '¡Tu cita fue agendada exitosamente! Te contactaremos pronto.');
    }

    public function getHorariosDisponibles(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'fecha' => 'required|date|after_or_equal:today',
        ]);

        $doctor = Doctor::findOrFail($request->doctor_id);

        // Obtener horarios disponibles del doctor para esa fecha
        $horariosDisponibles = HorarioDisponible::where('doctor_id', $doctor->id)
            ->where('fecha', $request->fecha)
            ->where('disponible', true)
            ->get();

        // Obtener citas ya agendadas para esa fecha
        $citasOcupadas = Cita::where('doctor_id', $doctor->id)
            ->whereDate('fecha', $request->fecha)
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->get()
            ->map(function ($cita) {
                return Carbon::createFromTimeString($cita->hora)->format('H:i');
            })
            ->toArray();

        // Generar horas disponibles basadas en los horarios
        $horasDisponibles = [];
        
        foreach ($horariosDisponibles as $horario) {
            $horaInicio = Carbon::createFromTimeString($horario->hora_inicio);
            $horaFin = Carbon::createFromTimeString($horario->hora_fin);
            $horaActual = $horaInicio->copy();
            $duracion = $doctor->duracion_cita ?? 30;

            while ($horaActual->copy()->addMinutes($duracion)->lte($horaFin)) {
                $horaStr = $horaActual->format('H:i');
                
                if (!in_array($horaStr, $citasOcupadas)) {
                    $horasDisponibles[] = $horaStr;
                }
                
                $horaActual->addMinutes($duracion);
            }
        }

        return response()->json($horasDisponibles);
    }

    public function updateEstado(Request $request, Cita $cita)
    {
        $user = Auth::user();
        
        if (!$user->isDoctor() || $cita->doctor_id !== $user->doctor->id) {
            return back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $request->validate([
            'estado' => 'required|in:pendiente,confirmada,completada,cancelada',
        ]);

        $cita->update(['estado' => $request->estado]);

        return back()->with('success', 'Estado de la cita actualizado correctamente.');
    }

    public function destroy(Cita $cita)
    {
        $user = Auth::user();
        
        if (!$user->isDoctor() || $cita->doctor_id !== $user->doctor->id) {
            return back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $cita->delete();

        return back()->with('success', 'Cita eliminada correctamente.');
    }

    public function misCitas()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus citas.');
        }

        $user = Auth::user();
        
        // Obtener citas del paciente autenticado
        $citas = Cita::where(function($query) use ($user) {
                // Si tiene perfil de paciente, buscar por paciente_id
                if ($user->paciente) {
                    $query->where('paciente_id', $user->paciente->id);
                }
                // También buscar por email para citas agendadas sin cuenta
                $query->orWhere('email_paciente', $user->email);
            })
            ->with(['doctor.user'])
            ->orderBy('fecha', 'desc')
            ->orderBy('hora', 'desc')
            ->get();

        // Estadísticas
        $estadisticas = [
            'total' => $citas->count(),
            'pendientes' => $citas->where('estado', 'pendiente')->count(),
            'confirmadas' => $citas->where('estado', 'confirmada')->count(),
            'completadas' => $citas->where('estado', 'completada')->count(),
            'canceladas' => $citas->where('estado', 'cancelada')->count(),
        ];

        return view('citas.mis-citas', compact('citas', 'estadisticas'));
    }
}
