export interface Salario {
    id: number;
    empleado_id: number;
    monto: number;
    tipo: string;
}

export interface Reporte {
    id: number;
    empleado_id: number;
    fecha_emision: string;
    contenido: string;
    tipo: string;
}

export interface Notificacion {
    id: number;
    empleado_id: number;
    mensaje: string;
    fecha_envio: string;
    tipo: string;
}

export interface IEmpleado {
    id: number;
    dni: string;
    nombre: string;
    fecha_ingreso: string;
    tipo: string;
    salarios?: Salario[];
    reportes?: Reporte[];
    notificaciones?: Notificacion[];
    calcularSalario(): number;
}
