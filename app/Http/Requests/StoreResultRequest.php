<?php

/**
 * StoreResultRequest
 *
 * Valida el payload que manda el frontend al terminar el quiz.
 * Si la validación falla, Laravel devuelve automáticamente
 * un 422 con los errores sin llegar al controlador.
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreResultRequest extends FormRequest
{
    /**
     * Todos los usuarios pueden hacer esta petición.
     * No hay autenticación en este recurso educativo.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación del payload.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'                       => ['required', 'string', 'max:50'],
            'score'                      => ['required', 'integer', 'min:0', 'max:10'],
            'total'                      => ['required', 'integer', 'min:1', 'max:10'],
            'answers'                    => ['required', 'array', 'min:1'],
            'answers.*.questionId'       => ['required', 'integer'],
            'answers.*.selectedIndex'    => ['required', 'integer', 'min:0'],
            'answers.*.isCorrect'        => ['required', 'boolean'],
        ];
    }

    /**
     * Mensajes de error personalizados en español.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'                    => 'El nombre es obligatorio.',
            'name.max'                         => 'El nombre no puede tener más de 50 caracteres.',
            'score.required'                   => 'El score es obligatorio.',
            'score.integer'                    => 'El score debe ser un número entero.',
            'score.min'                        => 'El score no puede ser negativo.',
            'score.max'                        => 'El score no puede ser mayor al total de preguntas.',
            'total.required'                   => 'El total es obligatorio.',
            'answers.required'                 => 'Las respuestas son obligatorias.',
            'answers.array'                    => 'Las respuestas deben ser un array.',
            'answers.*.questionId.required'    => 'Cada respuesta debe tener un questionId.',
            'answers.*.selectedIndex.required' => 'Cada respuesta debe tener un selectedIndex.',
            'answers.*.isCorrect.required'     => 'Cada respuesta debe indicar si es correcta.',
        ];
    }
}
