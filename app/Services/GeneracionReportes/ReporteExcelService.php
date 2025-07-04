<?php

namespace App\Services\GeneracionReportes;

use App\Contracts\Services\ReporteServiceInterface;
use Illuminate\Support\Collection;

class ReporteExcelService implements ReporteServiceInterface
{
    public function generar(Collection $empleados, array $params = []): mixed
    {
        // Aquí iría la lógica real de generación de Excel
        // return Excel::create($empleados, $params);
        return 'Excel generado';
    }
}
