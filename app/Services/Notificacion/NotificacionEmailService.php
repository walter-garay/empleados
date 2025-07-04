<?php

namespace App\Services\Notificacion;

use App\Contracts\Services\ServicioNotificacionInterface;
use App\Models\Empleado;

class NotificacionEmailService implements ServicioNotificacionInterface
{
    public function notificar(Empleado $empleado, string $mensaje): void
    {
        // Aquí iría la lógica real de envío de correo
        // Por ejemplo: Mail::to($empleado->email)->send(new NotificacionMail($mensaje));
    }
}
