<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    // Tabla correcta
    protected $table = 'doctors';

    protected $fillable = [
        'user_id',
        'especialidad',
        'hora_inicio',
        'hora_fin',
        'duracion_cita',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function horariosDisponibles()
    {
        return $this->hasMany(HorarioDisponible::class);
    }
}
