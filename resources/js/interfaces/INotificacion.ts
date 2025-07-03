export interface INotificacion {
    id?: number;
    empleado_id: number;
    mensaje: string;
    fecha_envio: string;
    tipo: string;
    enviarNotificacion(): Promise<boolean>;
}
