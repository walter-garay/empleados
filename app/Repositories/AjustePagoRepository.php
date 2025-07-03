<?php

namespace App\Repositories;

use App\Models\AjustePago;
use Illuminate\Database\Eloquent\Collection;

class AjustePagoRepository
{
    /**
     * Obtener todos los ajustes de pago, con relaciones opcionales.
     *
     * @param array $relations
     * @return Collection
     */
    public function getAll(array $relations = []): Collection
    {
        return AjustePago::with($relations)->get();
    }

    /**
     * Obtener un ajuste de pago por su ID, con relaciones opcionales.
     *
     * @param int $id
     * @param array $relations
     * @return AjustePago|null
     */
    public function getById(int $id, array $relations = []): ?AjustePago
    {
        return AjustePago::with($relations)->find($id);
    }

    /**
     * Crear un nuevo ajuste de pago.
     *
     * @param array $data
     * @return AjustePago
     */
    public function create(array $data): AjustePago
    {
        return AjustePago::create($data);
    }

    /**
     * Actualizar un ajuste de pago existente.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $ajuste = $this->getById($id);
        if ($ajuste) {
            return $ajuste->update($data);
        }
        return false;
    }

    /**
     * Eliminar un ajuste de pago por su ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $ajuste = $this->getById($id);
        if ($ajuste) {
            return $ajuste->delete();
        }
        return false;
    }
}
