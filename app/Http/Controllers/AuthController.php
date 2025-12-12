<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Paciente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            if ($user->isDoctor()) {
                return redirect()->route('doctor.dashboard');
            }
            
            return redirect()->intended('/principal');
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('registro');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'telefono' => 'nullable|string|max:20',
            'role' => 'required|in:doctor,paciente',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'role' => $request->role,
        ]);

        // Crear perfil según el rol
        if ($request->role === 'doctor') {
            Doctor::create([
                'user_id' => $user->id,
                'especialidad' => $request->especialidad ?? 'General',
                'hora_inicio' => '08:00',
                'hora_fin' => '18:00',
                'duracion_cita' => 30,
            ]);
        } else {
            Paciente::create([
                'user_id' => $user->id,
            ]);
        }

        Auth::login($user);

        if ($user->isDoctor()) {
            return redirect()->route('doctor.dashboard');
        }

        return redirect('/principal');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
