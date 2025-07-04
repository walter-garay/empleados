<?php

namespace App\Contracts\Services;

use Illuminate\Support\Collection;

interface ReporteServiceInterface
{
    public function generar(Collection $empleados, array $params = []): mixed;
}
