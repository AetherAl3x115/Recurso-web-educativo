<?php

/**
 * ResultCollection
 *
 * Transforma una colección de modelos Result a un array JSON.
 * Se usa en index() del controlador para devolver
 * los últimos 10 resultados.
 * Cada item de la colección pasa por ResultResource.
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ResultCollection extends ResourceCollection
{
    /**
     * El resource individual que se aplica a cada item.
     * Laravel aplica ResultResource a cada Result de la colección.
     */
    public $collects = ResultResource::class;

    /**
     * Transforma la colección a un array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection,
        ];
    }
}
