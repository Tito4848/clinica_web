<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario doctor de prueba
        $user = User::firstOrCreate(
            ['email' => 'doctor@clinica.com'],
            [
                'name' => 'Dr. Juan Pérez',
                'email' => 'doctor@clinica.com',
                'password' => Hash::make('password123'),
                'role' => 'doctor',
                'telefono' => '987654321',
            ]
        );

        // Crear perfil de doctor si no existe
        if (!$user->doctor) {
            Doctor::create([
                'user_id' => $user->id,
                'especialidad' => 'Consulta General',
                'codigo_colegiatura' => '12345',
                'hora_inicio' => '08:00',
                'hora_fin' => '18:00',
                'duracion_cita' => 30,
            ]);
        }

        // Crear otro doctor de ejemplo
        $user2 = User::firstOrCreate(
            ['email' => 'doctora@clinica.com'],
            [
                'name' => 'Dra. María García',
                'email' => 'doctora@clinica.com',
                'password' => Hash::make('password123'),
                'role' => 'doctor',
                'telefono' => '987654322',
            ]
        );

        if (!$user2->doctor) {
            Doctor::create([
                'user_id' => $user2->id,
                'especialidad' => 'Pediatría',
                'codigo_colegiatura' => '12346',
                'hora_inicio' => '09:00',
                'hora_fin' => '17:00',
                'duracion_cita' => 30,
            ]);
        }

        $this->command->info('Usuarios doctores creados exitosamente!');
        $this->command->info('Email: doctor@clinica.com / doctora@clinica.com');
        $this->command->info('Password: password123');
    }
}

