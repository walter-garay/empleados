<?php

namespace App\Services\Notificacion;

use App\Contracts\Services\ServicioNotificacionInterface;
use App\Models\Empleado;

class NotificacionSmsService implements ServicioNotificacionInterface
{
    public function notificar(Empleado $empleado, string $mensaje): void
    {
        // Aquí iría la lógica real de envío de SMS
        // Por ejemplo: SmsProvider::send($empleado->telefono, $mensaje);
    }
}
