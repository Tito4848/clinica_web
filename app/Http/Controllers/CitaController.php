<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Doctor;
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
            'especialidad' => 'required|string',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required',
            'mensaje' => 'nullable|string|max:1000',
        ]);

        // Buscar un doctor disponible para la especialidad
        $doctor = Doctor::where('especialidad', $request->especialidad)
            ->first();

        if (!$doctor) {
            return back()->withErrors(['especialidad' => 'No hay doctores disponibles para esta especialidad.'])->withInput();
        }

        // Verificar si el paciente está autenticado
        $pacienteId = null;
        if (Auth::check() && Auth::user()->isPaciente()) {
            $pacienteId = Auth::user()->paciente->id ?? null;
        }

        // Verificar disponibilidad
        $fechaHora = Carbon::parse($request->fecha . ' ' . $request->hora);
        
        $citaExistente = Cita::where('doctor_id', $doctor->id)
            ->whereDate('fecha', $fechaHora->format('Y-m-d'))
            ->whereTime('hora', $fechaHora->format('H:i:s'))
            ->whereIn('estado', ['pendiente', 'confirmada'])
            ->exists();

        if ($citaExistente) {
            return back()->withErrors(['fecha' => 'Esta hora ya está ocupada. Por favor seleccione otra.'])->withInput();
        }

        Cita::create([
            'doctor_id' => $doctor->id,
            'paciente_id' => $pacienteId,
            'nombre_paciente' => $request->nombre,
            'email_paciente' => $request->email,
            'telefono_paciente' => $request->telefono,
            'fecha' => $fechaHora->format('Y-m-d'),
            'hora' => $fechaHora->format('H:i:s'),
            'especialidad' => $request->especialidad,
            'estado' => 'pendiente',
            'comentarios' => $request->mensaje,
        ]);

        return redirect()->route('solicitar.cita')->with('success', '¡Tu cita fue agendada exitosamente! Te contactaremos pronto.');
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
}
