import { Notificacion } from './Notificacion';

export class NotificacionSMS extends Notificacion {
    constructor(empleado_id: number, mensaje: string) {
        super(empleado_id, mensaje, 'sms');
    }

    async enviarNotificacion(): Promise<boolean> {
        try {
            // Simular envío de SMS
            console.log(`Enviando SMS al empleado ${this.empleado_id}: ${this.mensaje}`);

            // Simular delay de envío
            await new Promise((resolve) => setTimeout(resolve, 800));

            console.log('SMS enviado exitosamente');
            return true;
        } catch (error) {
            console.error('Error enviando SMS:', error);
            return false;
        }
    }
}
