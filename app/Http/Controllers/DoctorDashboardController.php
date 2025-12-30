<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Doctor;
use App\Models\HorarioDisponible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DoctorDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        
        if (!$user->isDoctor()) {
            return redirect('/principal')->with('error', 'Acceso denegado');
        }

        $doctor = $user->doctor;
        
        if (!$doctor) {
            return redirect('/principal')->with('error', 'Perfil de doctor no encontrado');
        }

        // Cargar relación user
        $doctor->load('user');

        // Citas del doctor
        $citas = Cita::where('doctor_id', $doctor->id)
            ->orderBy('fecha', 'asc')
            ->orderBy('hora', 'asc')
            ->get();

        // Citas de hoy
        $citasHoy = Cita::where('doctor_id', $doctor->id)
            ->whereDate('fecha', today())
            ->orderBy('hora', 'asc')
            ->get();

        // Citas pendientes
        $citasPendientes = Cita::where('doctor_id', $doctor->id)
            ->where('estado', 'pendiente')
            ->count();

        // Estadísticas
        $estadisticas = [
            'total_citas' => $citas->count(),
            'citas_hoy' => $citasHoy->count(),
            'pendientes' => $citasPendientes,
            'confirmadas' => Cita::where('doctor_id', $doctor->id)->where('estado', 'confirmada')->count(),
        ];

        return view('doctor.dashboard', compact('doctor', 'citas', 'citasHoy', 'estadisticas'));
    }

    public function calendario()
    {
        $user = Auth::user();
        
        if (!$user->isDoctor()) {
            return redirect('/principal')->with('error', 'Acceso denegado');
        }

        $doctor = $user->doctor;
        
        if (!$doctor) {
            return redirect('/principal')->with('error', 'Perfil de doctor no encontrado');
        }

        // Cargar relación user
        $doctor->load('user');

        // Obtener todas las citas para el calendario
        $citas = Cita::where('doctor_id', $doctor->id)
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->get()
            ->map(function ($cita) {
                $hora = Carbon::createFromTimeString($cita->hora);
                return [
                    'id' => $cita->id,
                    'title' => $cita->nombre_paciente . ' - ' . $cita->especialidad,
                    'start' => $cita->fecha->format('Y-m-d') . 'T' . $hora->format('H:i:s'),
                    'color' => $cita->estado === 'confirmada' ? '#28a745' : '#ffc107',
                ];
            });

        return view('doctor.calendario', compact('doctor', 'citas'));
    }

    public function getHorasDisponibles(Request $request)
    {
        $user = Auth::user();
        $doctor = $user->doctor;

        $fecha = Carbon::parse($request->fecha);
        $horaInicio = Carbon::createFromTimeString($doctor->hora_inicio);
        $horaFin = Carbon::createFromTimeString($doctor->hora_fin);
        $duracion = $doctor->duracion_cita;

        // Obtener citas existentes para esa fecha
        $citasExistentes = Cita::where('doctor_id', $doctor->id)
            ->whereDate('fecha', $fecha)
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->get()
            ->map(function ($cita) {
                return Carbon::createFromTimeString($cita->hora)->format('H:i');
            })
            ->toArray();

        // Generar horas disponibles
        $horasDisponibles = [];
        $horaActual = $horaInicio->copy();

        while ($horaActual->copy()->addMinutes($duracion)->lte($horaFin)) {
            $horaStr = $horaActual->format('H:i');
            
            if (!in_array($horaStr, $citasExistentes)) {
                $horasDisponibles[] = $horaStr;
            }
            
            $horaActual->addMinutes($duracion);
        }

        return response()->json($horasDisponibles);
    }

    public function horarios()
    {
        $user = Auth::user();
        
        if (!$user->isDoctor()) {
            return redirect('/principal')->with('error', 'Acceso denegado');
        }

        $doctor = $user->doctor;
        
        if (!$doctor) {
            return redirect('/principal')->with('error', 'Perfil de doctor no encontrado');
        }

        // Cargar relación user
        $doctor->load('user');

        // Obtener horarios disponibles del doctor
        $horarios = HorarioDisponible::where('doctor_id', $doctor->id)
            ->where('fecha', '>=', today())
            ->orderBy('fecha', 'asc')
            ->orderBy('hora_inicio', 'asc')
            ->get();

        return view('doctor.horarios', compact('doctor', 'horarios'));
    }

    public function storeHorario(Request $request)
    {
        $user = Auth::user();
        
        if (!$user->isDoctor()) {
            return back()->with('error', 'Acceso denegado');
        }

        $doctor = $user->doctor;
        
        if (!$doctor) {
            return back()->with('error', 'Perfil de doctor no encontrado');
        }

        $request->validate([
            'fecha' => 'required|date|after_or_equal:today',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
        ]);

        // Verificar que no exista ya este horario
        $existe = HorarioDisponible::where('doctor_id', $doctor->id)
            ->where('fecha', $request->fecha)
            ->where('hora_inicio', $request->hora_inicio)
            ->where('hora_fin', $request->hora_fin)
            ->exists();

        if ($existe) {
            return back()->with('error', 'Este horario ya está registrado.');
        }

        HorarioDisponible::create([
            'doctor_id' => $doctor->id,
            'fecha' => $request->fecha,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'disponible' => true,
        ]);

        return back()->with('success', 'Horario agregado exitosamente.');
    }

    public function destroyHorario(HorarioDisponible $horario)
    {
        $user = Auth::user();
        
        if (!$user->isDoctor() || $horario->doctor_id !== $user->doctor->id) {
            return back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        // Verificar si hay citas en este horario
        $citas = Cita::where('doctor_id', $horario->doctor_id)
            ->whereDate('fecha', $horario->fecha)
            ->whereTime('hora', '>=', $horario->hora_inicio)
            ->whereTime('hora', '<=', $horario->hora_fin)
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->exists();

        if ($citas) {
            return back()->with('error', 'No se puede eliminar este horario porque tiene citas programadas.');
        }

        $horario->delete();

        return back()->with('success', 'Horario eliminado correctamente.');
    }

    public function toggleHorario(HorarioDisponible $horario)
    {
        $user = Auth::user();
        
        if (!$user->isDoctor() || $horario->doctor_id !== $user->doctor->id) {
            return back()->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $horario->update([
            'disponible' => !$horario->disponible,
        ]);

        return back()->with('success', 'Estado del horario actualizado.');
    }
}
