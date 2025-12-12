<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Paciente extends Model
{
    protected $fillable = [
        'user_id',
        'fecha_nacimiento',
        'dni',
        'direccion',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function citas(): HasMany
    {
        return $this->hasMany(Cita::class);
    }
}
