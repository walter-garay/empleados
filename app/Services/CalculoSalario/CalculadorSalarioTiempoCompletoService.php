<?php

namespace App\Services\CalculoSalario;

use App\Contracts\Services\CalculadorSalarioInterface;
use App\Models\Empleado;

class CalculadorSalarioTiempoCompletoService implements CalculadorSalarioInterface
{
    public function calcular(Empleado $empleado): float
    {
        // Se asume que el salario mensual es el salario base para tiempo completo
        return (float) ($empleado->salario_mensual ?? 0);
    }
}
