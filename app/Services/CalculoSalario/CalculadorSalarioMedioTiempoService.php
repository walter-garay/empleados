<?php

namespace App\Services\CalculoSalario;

use App\Contracts\Services\CalculadorSalarioInterface;
use App\Models\Empleado;

class CalculadorSalarioMedioTiempoService implements CalculadorSalarioInterface
{
    public function calcular(Empleado $empleado): float
    {
        // Se asume que el salario mensual es la base, pero se paga la mitad para medio tiempo
        return (float) ($empleado->salario_mensual ? $empleado->salario_mensual / 2 : 0);
    }
}
