<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cita extends Model
{
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
    ];

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class);
    }

    public function paciente(): BelongsTo
    {
        return $this->belongsTo(Paciente::class);
    }
}
