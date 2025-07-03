<?php

namespace Database\Factories;

use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmpleadoFactory extends Factory
{
    protected $model = Empleado::class;

    public function definition()
    {
        $tipos = ['tiempo_completo', 'medio_tiempo', 'contratista'];
        return [
            'dni' => $this->faker->unique()->numerify('########'),
            'nombre' => $this->faker->name(),
            'fecha_ingreso' => $this->faker->date(),
            'tipo' => $this->faker->randomElement($tipos),
        ];
    }
}
