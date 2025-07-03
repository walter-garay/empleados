<?php

namespace Database\Factories;

use App\Models\AjustePago;
use App\Models\Pago;
use Illuminate\Database\Eloquent\Factories\Factory;

class AjustePagoFactory extends Factory
{
    protected $model = AjustePago::class;

    public function definition()
    {
        $tipos = ['bono', 'descuento', 'ajuste'];
        return [
            'pago_id' => Pago::factory(),
            'tipo' => $this->faker->randomElement($tipos),
            'descripcion' => $this->faker->sentence(),
            'monto' => $this->faker->numberBetween(50, 500),
        ];
    }
}
