<?php
// app/Repositories/EmpleadoRepository.php

namespace App\Repositories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Collection;

class EmpleadoRepository
{
    /**
     * Obtener todos los empleados, con relaciones opcionales.
     *
     * @param array $relations
     * @return Collection
     */
    public function getAll(array $relations = []): Collection
    {
        return Empleado::with($relations)->get();
    }

    /**
     * Obtener un empleado por su ID, con relaciones opcionales.
     *
     * @param int $id
     * @param array $relations
     * @return Empleado|null
     */
    public function getById(int $id, array $relations = []): ?Empleado
    {
        return Empleado::with($relations)->find($id);
    }

    /**
     * Crear un nuevo empleado.
     *
     * @param array $data
     * @return Empleado
     */
    public function create(array $data): Empleado
    {
        return Empleado::create($data);
    }

    /**
     * Actualizar un empleado existente.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $empleado = $this->getById($id);
        if ($empleado) {
            return $empleado->update($data);
        }
        return false;
    }

    /**
     * Eliminar un empleado por su ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $empleado = $this->getById($id);
        if ($empleado) {
            return $empleado->delete();
        }
        return false;
    }
}
