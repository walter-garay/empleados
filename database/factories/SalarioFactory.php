<?php

namespace Database\Factories;

use App\Models\Salario;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalarioFactory extends Factory
{
    protected $model = Salario::class;

    public function definition()
    {
        $tipos = ['mensual', 'quincenal', 'por_hora'];
        return [
            'empleado_id' => Empleado::factory(),
            'monto' => $this->faker->numberBetween(1000, 5000),
            'tipo' => $this->faker->randomElement($tipos),
        ];
    }
}
