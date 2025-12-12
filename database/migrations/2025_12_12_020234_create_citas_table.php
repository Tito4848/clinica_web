<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained('doctores')->onDelete('cascade');
            $table->foreignId('paciente_id')->nullable()->constrained('pacientes')->onDelete('set null');
            $table->string('nombre_paciente'); // Por si no está registrado
            $table->string('email_paciente');
            $table->string('telefono_paciente');
            $table->date('fecha');
            $table->time('hora');
            $table->string('especialidad');
            $table->enum('estado', ['pendiente', 'confirmada', 'completada', 'cancelada'])->default('pendiente');
            $table->text('comentarios')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
