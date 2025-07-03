<?php

namespace App\Services;

use App\Repositories\EmpleadoRepository;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Collection;

class EmpleadoService
{
    protected EmpleadoRepository $empleadoRepository;

    public function __construct(EmpleadoRepository $empleadoRepository)
    {
        $this->empleadoRepository = $empleadoRepository;
    }

    /**
     * Obtener todos los empleados, con relaciones opcionales.
     *
     * @param array $relations
     * @return Collection
     */
    public function getAllEmpleados(array $relations = []): Collection
    {
        return $this->empleadoRepository->getAll($relations);
    }

    /**
     * Obtener un empleado por su ID, con relaciones opcionales.
     *
     * @param int $id
     * @param array $relations
     * @return Empleado|null
     */
    public function getEmpleadoById(int $id, array $relations = []): ?Empleado
    {
        return $this->empleadoRepository->getById($id, $relations);
    }

    /**
     * Crear un nuevo empleado.
     *
     * @param array $data
     * @return Empleado
     */
    public function createEmpleado(array $data): Empleado
    {
        return $this->empleadoRepository->create($data);
    }

    /**
     * Actualizar un empleado existente.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateEmpleado(int $id, array $data): bool
    {
        return $this->empleadoRepository->update($id, $data);
    }

    /**
     * Eliminar un empleado por su ID.
     *
     * @param int $id
     * @return bool
     */
    public function deleteEmpleado(int $id): bool
    {
        return $this->empleadoRepository->delete($id);
    }
}
