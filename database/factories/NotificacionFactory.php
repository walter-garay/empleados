<?php

namespace Database\Factories;

use App\Models\Notificacion;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class NotificacionFactory extends Factory
{
    protected $model = Notificacion::class;

    public function definition()
    {
        $tipos = ['email', 'sms'];
        return [
            'empleado_id' => Empleado::factory(),
            'mensaje' => $this->faker->sentence(),
            'fecha_envio' => $this->faker->dateTimeThisYear(),
            'tipo' => $this->faker->randomElement($tipos),
        ];
    }
}
