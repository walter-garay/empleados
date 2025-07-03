<?php

namespace App\Repositories;

use App\Models\Reporte;
use Illuminate\Database\Eloquent\Collection;

class ReporteRepository
{
    /**
     * Obtener todos los reportes, con relaciones opcionales.
     *
     * @param array $relations
     * @return Collection
     */
    public function getAll(array $relations = []): Collection
    {
        return Reporte::with($relations)->get();
    }

    /**
     * Obtener un reporte por su ID, con relaciones opcionales.
     *
     * @param int $id
     * @param array $relations
     * @return Reporte|null
     */
    public function getById(int $id, array $relations = []): ?Reporte
    {
        return Reporte::with($relations)->find($id);
    }

    /**
     * Crear un nuevo reporte.
     *
     * @param array $data
     * @return Reporte
     */
    public function create(array $data): Reporte
    {
        return Reporte::create($data);
    }

    /**
     * Actualizar un reporte existente.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $reporte = $this->getById($id);
        if ($reporte) {
            return $reporte->update($data);
        }
        return false;
    }

    /**
     * Eliminar un reporte por su ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $reporte = $this->getById($id);
        if ($reporte) {
            return $reporte->delete();
        }
        return false;
    }
}
