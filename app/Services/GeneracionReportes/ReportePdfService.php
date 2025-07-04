<?php

namespace App\Services\GeneracionReportes;

use App\Contracts\Services\ReporteServiceInterface;
use Illuminate\Support\Collection;

class ReportePdfService implements ReporteServiceInterface
{
    public function generar(Collection $empleados, array $params = []): mixed
    {
        // Aquí iría la lógica real de generación de PDF
        // return PDF::create($empleados, $params);
        return 'PDF generado';
    }
}
