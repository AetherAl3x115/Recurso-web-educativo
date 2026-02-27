<?php

/**
 * ResultService
 *
 * Contiene toda la lógica de negocio relacionada con los resultados del quiz.
 * El controlador delega aquí todas las operaciones, manteniéndose limpio
 * y con una sola responsabilidad: recibir la request y devolver la response.
 */

namespace App\Services;

use App\Models\Result;
use Illuminate\Database\Eloquent\Collection;

class ResultService
{
    /**
     * Obtiene los últimos 10 resultados ordenados por fecha descendente.
     * Se usa en index() para la tabla de resultados recientes.
     *
     * @return Collection<int, Result>
     */
    public function getLatest(): Collection
    {
        return Result::latest()
            ->limit(10)
            ->get();
    }

    /**
     * Crea y guarda un nuevo resultado en la base de datos.
     * Recibe los datos ya validados por StoreResultRequest.
     *
     * @param array<string, mixed> $data - Datos validados del request
     * @return Result
     */
    public function store(array $data): Result
    {
        return Result::create($data);
    }

    /**
     * Busca y devuelve un resultado por su ID.
     * Se usa en show() para el modal de detalle en /resultados.
     * Lanza ModelNotFoundException si no existe, Laravel lo convierte en 404.
     *
     * @param int $id
     * @return Result
     */
    public function findById(int $id): Result
    {
        return Result::findOrFail($id);
    }
}
