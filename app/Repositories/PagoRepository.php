<?php

namespace App\Repositories;

use App\Models\Pago;
use Illuminate\Database\Eloquent\Collection;

class PagoRepository
{
    /**
     * Obtener todos los pagos, con relaciones opcionales.
     *
     * @param array $relations
     * @return Collection
     */
    public function getAll(array $relations = []): Collection
    {
        return Pago::with($relations)->get();
    }

    /**
     * Obtener un pago por su ID, con relaciones opcionales.
     *
     * @param int $id
     * @param array $relations
     * @return Pago|null
     */
    public function getById(int $id, array $relations = []): ?Pago
    {
        return Pago::with($relations)->find($id);
    }

    /**
     * Crear un nuevo pago.
     *
     * @param array $data
     * @return Pago
     */
    public function create(array $data): Pago
    {
        return Pago::create($data);
    }

    /**
     * Actualizar un pago existente.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $pago = $this->getById($id);
        if ($pago) {
            return $pago->update($data);
        }
        return false;
    }

    /**
     * Eliminar un pago por su ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $pago = $this->getById($id);
        if ($pago) {
            return $pago->delete();
        }
        return false;
    }
}
