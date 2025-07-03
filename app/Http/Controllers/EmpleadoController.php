<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\EmpleadoService;
use Illuminate\Http\JsonResponse;

class EmpleadoController extends Controller
{
    protected EmpleadoService $empleadoService;

    public function __construct(EmpleadoService $empleadoService)
    {
        $this->empleadoService = $empleadoService;
    }

    /**
     * Listar empleados (con relaciones opcionales por query param 'with').
     */
    public function index(Request $request): JsonResponse
    {
        $relations = $request->query('with', []);
        if (is_string($relations)) {
            $relations = explode(',', $relations);
        }
        $empleados = $this->empleadoService->getAllEmpleados($relations);
        return response()->json($empleados);
    }

    /**
     * Mostrar un empleado por ID (con relaciones opcionales por query param 'with').
     */
    public function show(Request $request, int $id): JsonResponse
    {
        $relations = $request->query('with', []);
        if (is_string($relations)) {
            $relations = explode(',', $relations);
        }
        $empleado = $this->empleadoService->getEmpleadoById($id, $relations);
        if (!$empleado) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
        return response()->json($empleado);
    }

    /**
     * Crear un nuevo empleado.
     */
    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'dni' => 'required|string|unique:empleados,dni',
            'nombre' => 'required|string',
            'fecha_ingreso' => 'required|date',
            'tipo' => 'required|string',
        ]);
        $empleado = $this->empleadoService->createEmpleado($data);
        return response()->json($empleado, 201);
    }

    /**
     * Actualizar un empleado existente.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->validate([
            'dni' => 'sometimes|required|string|unique:empleados,dni,' . $id,
            'nombre' => 'sometimes|required|string',
            'fecha_ingreso' => 'sometimes|required|date',
            'tipo' => 'sometimes|required|string',
        ]);
        $updated = $this->empleadoService->updateEmpleado($id, $data);
        if (!$updated) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
        return response()->json(['message' => 'Empleado actualizado correctamente']);
    }

    /**
     * Eliminar un empleado.
     */
    public function destroy(int $id): JsonResponse
    {
        $deleted = $this->empleadoService->deleteEmpleado($id);
        if (!$deleted) {
            return response()->json(['message' => 'Empleado no encontrado'], 404);
        }
        return response()->json(['message' => 'Empleado eliminado correctamente']);
    }
}
