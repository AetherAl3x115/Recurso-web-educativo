<?php

/**
 * ResultResource
 *
 * Transforma un modelo Result individual a un array JSON.
 * Controla exactamente qué campos se exponen en la API,
 * evitando exponer datos innecesarios o sensibles de la tabla.
 * Se usa en store() y show() del controlador.
 */

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    /**
     * Transforma el modelo a un array.
     * Solo expone los campos que el frontend necesita.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'         => $this->id,
            'name'       => $this->name,
            'score'      => $this->score,
            'total'      => $this->total,
            'answers'    => $this->answers,
            'created_at' => $this->created_at,
        ];
    }
}
