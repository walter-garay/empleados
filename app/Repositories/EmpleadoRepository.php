<?php
// app/Repositories/EmpleadoRepository.php

namespace App\Repositories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Collection;
use App\Contracts\Repositories\EmpleadoRepositoryInterface;

class EmpleadoRepository implements EmpleadoRepositoryInterface
{
    /**
     * Obtener todos los empleados, con relaciones y filtros opcionales.
     *
     * @param array $relations
     * @param array $filters
     * @return Collection<Empleado>
     */
    public function getAll(array $relations = [], array $filters = []): Collection
    {
        $query = Empleado::with($relations);
        foreach ($filters as $field => $value) {
            if (!is_null($value)) {
                $query->where($field, $value);
            }
        }
        return $query->get();
    }

    /**
     * Obtener un empleado por su ID, con relaciones y filtros opcionales.
     *
     * @param int $id
     * @param array $relations
     * @param array $filters
     * @return Empleado|null
     */
    public function getById(int $id, array $relations = [], array $filters = []): ?Empleado
    {
        $query = Empleado::with($relations)->where('id', $id);
        foreach ($filters as $field => $value) {
            if (!is_null($value)) {
                $query->where($field, $value);
            }
        }
        return $query->first();
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
