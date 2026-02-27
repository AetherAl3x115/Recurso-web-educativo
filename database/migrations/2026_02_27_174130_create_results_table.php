<?php

/**
 * Migration: create_results_table
 *
 * Crea la tabla que almacena los resultados del quiz de ciberseguridad.
 * Guarda el nombre del alumno, su score y el detalle de respuestas en JSON.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Crea la tabla results con todos sus campos.
     */
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('name');          // Nombre del alumno
            $table->unsignedTinyInteger('score');  // Respuestas correctas (0-10)
            $table->unsignedTinyInteger('total');  // Total de preguntas
            $table->json('answers');         // Detalle de respuestas por pregunta
            $table->timestamps();
        });
    }

    /**
     * Elimina la tabla results si se revierte la migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
