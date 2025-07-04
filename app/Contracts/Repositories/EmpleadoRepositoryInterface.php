<?php

namespace App\Contracts\Repositories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Collection;

interface EmpleadoRepositoryInterface
{
    public function getAll(array $relations = [], array $filters = []): Collection;
    public function getById(int $id, array $relations = [], array $filters = []): ?Empleado;
    public function create(array $data): Empleado;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
