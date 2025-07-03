import type { INotificacion } from '../../interfaces/INotificacion';

export abstract class Notificacion implements INotificacion {
    id?: number;
    empleado_id: number;
    mensaje: string;
    fecha_envio: string;
    tipo: string;

    constructor(empleado_id: number, mensaje: string, tipo: string) {
        this.empleado_id = empleado_id;
        this.mensaje = mensaje;
        this.tipo = tipo;
        this.fecha_envio = new Date().toISOString();
    }

    abstract enviarNotificacion(): Promise<boolean>;
}
