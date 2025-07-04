<?php

namespace App\Services\GeneracionReportes;

use App\Contracts\Services\ReporteServiceInterface;
use Illuminate\Support\Collection;

class ReporteJsonService implements ReporteServiceInterface
{
    public function generar(Collection $empleados, array $params = []): mixed
    {
        // Aquí iría la lógica real de generación de JSON
        return $empleados->toJson();
    }
}
