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

        // Crear más doctores de ejemplo
        $doctores = [
            [
                'name' => 'Dr. Carlos Ramírez',
                'email' => 'carlos.ramirez@clinica.com',
                'especialidad' => 'Cardiología',
                'telefono' => '987654323',
                'codigo_colegiatura' => '12347',
                'hora_inicio' => '08:00',
                'hora_fin' => '16:00',
            ],
            [
                'name' => 'Dra. Laura Fernández',
                'email' => 'laura.fernandez@clinica.com',
                'especialidad' => 'Ginecología',
                'telefono' => '987654324',
                'codigo_colegiatura' => '12348',
                'hora_inicio' => '09:00',
                'hora_fin' => '17:00',
            ],
            [
                'name' => 'Dr. Jorge Valdez',
                'email' => 'jorge.valdez@clinica.com',
                'especialidad' => 'Medicina Interna',
                'telefono' => '987654325',
                'codigo_colegiatura' => '12349',
                'hora_inicio' => '08:30',
                'hora_fin' => '18:30',
            ],
            [
                'name' => 'Dra. Ana Martínez',
                'email' => 'ana.martinez@clinica.com',
                'especialidad' => 'Dermatología',
                'telefono' => '987654326',
                'codigo_colegiatura' => '12350',
                'hora_inicio' => '10:00',
                'hora_fin' => '18:00',
            ],
            [
                'name' => 'Dr. Roberto Sánchez',
                'email' => 'roberto.sanchez@clinica.com',
                'especialidad' => 'Oftalmología',
                'telefono' => '987654327',
                'codigo_colegiatura' => '12351',
                'hora_inicio' => '08:00',
                'hora_fin' => '17:00',
            ],
            [
                'name' => 'Dra. Carmen López',
                'email' => 'carmen.lopez@clinica.com',
                'especialidad' => 'Psicología',
                'telefono' => '987654328',
                'codigo_colegiatura' => '12352',
                'hora_inicio' => '09:00',
                'hora_fin' => '19:00',
            ],
            [
                'name' => 'Dr. Miguel Torres',
                'email' => 'miguel.torres@clinica.com',
                'especialidad' => 'Laboratorio Clínico',
                'telefono' => '987654329',
                'codigo_colegiatura' => '12353',
                'hora_inicio' => '07:00',
                'hora_fin' => '15:00',
            ],
        ];

        foreach ($doctores as $doctorData) {
            $user = User::firstOrCreate(
                ['email' => $doctorData['email']],
                [
                    'name' => $doctorData['name'],
                    'email' => $doctorData['email'],
                    'password' => Hash::make('password123'),
                    'role' => 'doctor',
                    'telefono' => $doctorData['telefono'],
                ]
            );

            if (!$user->doctor) {
                Doctor::create([
                    'user_id' => $user->id,
                    'especialidad' => $doctorData['especialidad'],
                    'codigo_colegiatura' => $doctorData['codigo_colegiatura'],
                    'hora_inicio' => $doctorData['hora_inicio'],
                    'hora_fin' => $doctorData['hora_fin'],
                    'duracion_cita' => 30,
                ]);
            }
        }

        $this->command->info('Usuarios doctores creados exitosamente!');
        $this->command->info('Emails: doctor@clinica.com, doctora@clinica.com, y más...');
        $this->command->info('Password para todos: password123');
    }
}

