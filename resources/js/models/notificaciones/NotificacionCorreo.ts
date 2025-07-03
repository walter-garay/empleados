import { Notificacion } from './Notificacion';

export class NotificacionCorreo extends Notificacion {
    constructor(empleado_id: number, mensaje: string) {
        super(empleado_id, mensaje, 'correo');
    }

    async enviarNotificacion(): Promise<boolean> {
        try {
            // Simular envío de correo electrónico
            console.log(`Enviando correo al empleado ${this.empleado_id}: ${this.mensaje}`);

            // Simular delay de envío
            await new Promise((resolve) => setTimeout(resolve, 1200));

            console.log('Correo enviado exitosamente');
            return true;
        } catch (error) {
            console.error('Error enviando correo:', error);
            return false;
        }
    }
}
