<?php

namespace Database\Factories;

use App\Models\Pago;
use App\Models\Salario;
use Illuminate\Database\Eloquent\Factories\Factory;

class PagoFactory extends Factory
{
    protected $model = Pago::class;

    public function definition()
    {
        $metodos = ['transferencia', 'efectivo', 'cheque'];
        $periodos = ['enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre'];
        return [
            'salario_id' => Salario::factory(),
            'monto_pagado' => $this->faker->numberBetween(1000, 5000),
            'fecha_pago' => $this->faker->date(),
            'metodo_pago' => $this->faker->randomElement($metodos),
            'periodo' => $this->faker->randomElement($periodos),
        ];
    }
}
