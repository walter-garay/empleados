<?php

namespace App\Contracts\Services;

use App\Models\Empleado;

interface CalculadorSalarioInterface
{
    public function calcular(Empleado $empleado): float;
}
