<?php

namespace App\Repositories;

use App\Models\Salario;
use Illuminate\Database\Eloquent\Collection;

class SalarioRepository
{
    /**
     * Obtener todos los salarios, con relaciones opcionales.
     *
     * @param array $relations
     * @return Collection
     */
    public function getAll(array $relations = []): Collection
    {
        return Salario::with($relations)->get();
    }

    /**
     * Obtener un salario por su ID, con relaciones opcionales.
     *
     * @param int $id
     * @param array $relations
     * @return Salario|null
     */
    public function getById(int $id, array $relations = []): ?Salario
    {
        return Salario::with($relations)->find($id);
    }

    /**
     * Crear un nuevo salario.
     *
     * @param array $data
     * @return Salario
     */
    public function create(array $data): Salario
    {
        return Salario::create($data);
    }

    /**
     * Actualizar un salario existente.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $salario = $this->getById($id);
        if ($salario) {
            return $salario->update($data);
        }
        return false;
    }

    /**
     * Eliminar un salario por su ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $salario = $this->getById($id);
        if ($salario) {
            return $salario->delete();
        }
        return false;
    }
}
