<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('especialidad');
            $table->string('codigo_colegiatura')->unique()->nullable();
            $table->text('horario_atencion')->nullable();
            $table->time('hora_inicio')->default('08:00');
            $table->time('hora_fin')->default('18:00');
            $table->integer('duracion_cita')->default(30);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
