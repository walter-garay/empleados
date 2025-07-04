<?php

namespace App\Contracts\Resolvers;

use App\Models\Empleado;
use App\Contracts\Services\CalculadorSalarioInterface;

interface CalculadorSalarioResolverInterface
{
    public function resolve(Empleado $empleado): CalculadorSalarioInterface;
}
