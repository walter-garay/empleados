<?php

namespace App\Services\CalculoSalario;

use App\Contracts\Services\CalculadorSalarioInterface;
use App\Models\Empleado;

class CalculadorSalarioContratistaService implements CalculadorSalarioInterface
{
    public function calcular(Empleado $empleado): float
    {
        // Se asume que la tarifa de contrato es el pago para contratistas
        return (float) ($empleado->tarifa_contrato ?? 0);
    }
}
