<?php

/**
 * Model: Result
 *
 * Representa un resultado del quiz guardado en la base de datos.
 * Castea automáticamente el campo answers de JSON a array de PHP
 * para no tener que hacer json_decode() manualmente en ningún lado.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    /**
     * Campos que se pueden asignar masivamente.
     * Protege contra mass assignment attacks.
     */
    protected $fillable = [
        'name',
        'score',
        'total',
        'answers',
    ];

    /**
     * Casteos automáticos de tipos.
     * answers se guarda como JSON en MySQL pero Laravel lo convierte
     * a array de PHP al leerlo y viceversa automáticamente.
     */
    protected $casts = [
        'answers' => 'array',
        'score'   => 'integer',
        'total'   => 'integer',
    ];
}
