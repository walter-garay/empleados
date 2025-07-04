export interface IReporte {
    id?: number;
    empleado_id: number;
    fecha_emision: string;
    contenido: string;
    tipo: string;
    generar_reporte(data: any[]): void;
}
