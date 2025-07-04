<?php

namespace App\Contracts\Services;

use App\Models\Empleado;

interface ServicioNotificacionInterface
{
    public function notificar(Empleado $empleado, string $mensaje): void;
}
