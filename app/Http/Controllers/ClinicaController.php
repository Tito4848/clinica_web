<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;

class ClinicaController extends Controller
{
    public function index()
    {
        return view('clinica');
    }

    public function profesionales(Request $request)
    {
        $doctores = Doctor::with(['user', 'citas'])
            ->get()
            ->map(function ($doctor) {
                return [
                    'id' => $doctor->id,
                    'nombre' => $doctor->user->name,
                    'especialidad' => $doctor->especialidad,
                    'total_citas' => $doctor->citas->count(),
                    'citas_pendientes' => $doctor->citas->where('estado', 'pendiente')->count(),
                    'citas_confirmadas' => $doctor->citas->where('estado', 'confirmada')->count(),
                    'citas' => $doctor->citas->sortBy('fecha')->values(),
                ];
            });

        $doctorSeleccionado = null;
        if ($request->has('doctor')) {
            $doctorSeleccionado = Doctor::with(['user', 'citas'])->find($request->doctor);
        }

        return view('profesionalexperto', compact('doctores', 'doctorSeleccionado'));
    }
}
