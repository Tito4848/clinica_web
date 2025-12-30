<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cita extends Model
{
    protected $table = 'citas'; // 🔥 Recomendado

    protected $fillable = [
        'doctor_id',
        'paciente_id',
        'nombre_paciente',
        'email_paciente',
        'telefono_paciente',
        'fecha',
        'hora',
        'especialidad',
        'estado',
        'comentarios',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i', // 🔥 cast recomendado
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class)->with('user');
    }

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }

    // 🔥 Método opcional: retorna la hora siempre formateada
    public function getHoraFormateadaAttribute()
    {
        return date('H:i', strtotime($this->hora));
    }

    // 🔥 Método opcional: retorna fecha formateada
    public function getFechaFormateadaAttribute()
    {
        return $this->fecha->format('d/m/Y');
    }
}
