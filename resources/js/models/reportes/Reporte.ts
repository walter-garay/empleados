import type { IReporte } from '../../interfaces/IReporte';

export abstract class Reporte implements IReporte {
    id?: number;
    empleado_id: number;
    fecha_emision: string;
    contenido: string;
    tipo: string;

    constructor(data: IReporte) {
        this.id = data.id;
        this.empleado_id = data.empleado_id;
        this.fecha_emision = data.fecha_emision;
        this.contenido = data.contenido;
        this.tipo = data.tipo;
    }

    abstract generar_reporte(data: any[]): void;
}
