<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Empleado;
use App\Models\Salario;
use App\Models\Pago;
use App\Models\AjustePago;
use App\Models\Reporte;
use App\Models\Notificacion;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Crear 20 empleados
        $empleados = Empleado::factory(20)->create();

        // Crear 20 salarios, cada uno asociado a un empleado aleatorio
        $salarios = Salario::factory(20)->make()->each(function ($salario) use ($empleados) {
            $salario->empleado_id = $empleados->random()->id;
            $salario->save();
        });

        // Crear 20 pagos, cada uno asociado a un salario aleatorio
        $pagos = Pago::factory(20)->make()->each(function ($pago) use ($salarios) {
            $pago->salario_id = $salarios->random()->id;
            $pago->save();
        });

        // Crear 20 ajustes de pago, cada uno asociado a un pago aleatorio
        AjustePago::factory(20)->make()->each(function ($ajuste) use ($pagos) {
            $ajuste->pago_id = $pagos->random()->id;
            $ajuste->save();
        });

        // Crear 20 reportes, cada uno asociado a un empleado aleatorio
        Reporte::factory(20)->make()->each(function ($reporte) use ($empleados) {
            $reporte->empleado_id = $empleados->random()->id;
            $reporte->save();
        });

        // Crear 20 notificaciones, cada una asociada a un empleado aleatorio
        Notificacion::factory(20)->make()->each(function ($notificacion) use ($empleados) {
            $notificacion->empleado_id = $empleados->random()->id;
            $notificacion->save();
        });
    }
}
