<?php

namespace App\Repositories;

use App\Models\Notificacion;
use Illuminate\Database\Eloquent\Collection;

class NotificacionRepository
{
    /**
     * Obtener todas las notificaciones, con relaciones opcionales.
     *
     * @param array $relations
     * @return Collection
     */
    public function getAll(array $relations = []): Collection
    {
        return Notificacion::with($relations)->get();
    }

    /**
     * Obtener una notificación por su ID, con relaciones opcionales.
     *
     * @param int $id
     * @param array $relations
     * @return Notificacion|null
     */
    public function getById(int $id, array $relations = []): ?Notificacion
    {
        return Notificacion::with($relations)->find($id);
    }

    /**
     * Crear una nueva notificación.
     *
     * @param array $data
     * @return Notificacion
     */
    public function create(array $data): Notificacion
    {
        return Notificacion::create($data);
    }

    /**
     * Actualizar una notificación existente.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update(int $id, array $data): bool
    {
        $notificacion = $this->getById($id);
        if ($notificacion) {
            return $notificacion->update($data);
        }
        return false;
    }

    /**
     * Eliminar una notificación por su ID.
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $notificacion = $this->getById($id);
        if ($notificacion) {
            return $notificacion->delete();
        }
        return false;
    }
}
