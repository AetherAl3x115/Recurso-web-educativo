<?php

/**
 * api.php
 *
 * Rutas de la API de CiberSeguro.
 * Todas las rutas tienen el prefijo /api automáticamente.
 *
 * Endpoints disponibles:
 * GET    /api/results       → Lista los últimos 10 resultados
 * POST   /api/results       → Guarda un nuevo resultado
 * GET    /api/results/{id}  → Detalle de un resultado específico
 *
 * Nota: El CRUD completo (update, delete) se maneja desde un panel
 * administrativo interno para evitar que los alumnos alteren sus calificaciones.
 */

use App\Http\Controllers\ResultController;
use Illuminate\Support\Facades\Route;

Route::controller(ResultController::class)->group(function () {
    Route::get('/results', 'index');
    Route::post('/results', 'store');
    Route::get('/results/{id}', 'show');
});
