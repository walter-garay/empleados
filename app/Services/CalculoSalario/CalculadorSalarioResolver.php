<?php

namespace App\Services\CalculoSalario;

use App\Contracts\Services\CalculadorSalarioInterface;
use App\Models\Empleado;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Container\Container;

class CalculadorSalarioResolver
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function resolve(Empleado $empleado): CalculadorSalarioInterface
    {
        switch ($empleado->tipo ?? null) {
            case 'tiempo_completo':
                return $this->container->make(CalculadorSalarioTiempoCompletoService::class);
            case 'medio_tiempo':
                return $this->container->make(CalculadorSalarioMedioTiempoService::class);
            case 'contratista':
                return $this->container->make(CalculadorSalarioContratistaService::class);
            default:
                throw new BindingResolutionException('Tipo de empleado no soportado para cálculo de salario.');
        }
    }
}
