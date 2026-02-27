<?php

/**
 * ResultController
 *
 * Controlador de resultados del quiz.
 * Completamente limpio de lógica de negocio.
 * Solo recibe la request, delega al service y devuelve la response.
 *
 * Endpoints:
 * GET    /api/results       → index()  Lista los últimos 10 resultados
 * POST   /api/results       → store()  Guarda un nuevo resultado
 * GET    /api/results/{id}  → show()   Devuelve el detalle de un resultado
 */

namespace App\Http\Controllers;

use App\Http\Requests\StoreResultRequest;
use App\Http\Resources\ResultCollection;
use App\Http\Resources\ResultResource;
use App\Services\ResultService;
use Illuminate\Http\JsonResponse;

class ResultController extends Controller
{
    /**
     * Inyección de dependencias del service.
     * Laravel resuelve automáticamente ResultService sin configuración extra.
     */
    public function __construct(
        private readonly ResultService $resultService
    ) {}

    /**
     * Devuelve los últimos 10 resultados del quiz.
     * Usado por la vista /resultados para llenar la tabla.
     *
     * @return ResultCollection
     */
    public function index(): ResultCollection
    {
        $results = $this->resultService->getLatest();
        return new ResultCollection($results);
    }

    /**
     * Guarda el resultado del quiz de un alumno.
     * La validación la maneja StoreResultRequest antes de llegar aquí.
     * Usado cuando el alumno termina el quiz e ingresa su nombre.
     *
     * @param StoreResultRequest $request
     * @return JsonResponse
     */
    public function store(StoreResultRequest $request): JsonResponse
    {
        $result = $this->resultService->store($request->validated());

        return response()->json([
            'message' => 'Resultado guardado exitosamente.',
            'result'  => new ResultResource($result),
        ], 201);
    }

    /**
     * Devuelve el detalle de un resultado específico.
     * Usado por el modal "Ver detalles" en la vista /resultados.
     * Devuelve 404 automáticamente si el ID no existe.
     *
     * @param int $id
     * @return ResultResource
     */
    public function show(int $id): ResultResource
    {
        $result = $this->resultService->findById($id);
        return new ResultResource($result);
    }
}
