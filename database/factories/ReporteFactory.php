<?php

namespace Database\Factories;

use App\Models\Reporte;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReporteFactory extends Factory
{
    protected $model = Reporte::class;

    public function definition()
    {
        $tipos = ['pdf', 'excel', 'json'];
        return [
            'empleado_id' => Empleado::factory(),
            'fecha_emision' => $this->faker->date(),
            'contenido' => $this->faker->paragraph(),
            'tipo' => $this->faker->randomElement($tipos),
        ];
    }
}
