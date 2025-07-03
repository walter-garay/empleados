export interface IPago {
    id?: number;
    empleado_id: number;
    monto: number;
    metodo_pago: string;
    fecha_pago: string;
    estado: string;
    procesarPago(): Promise<boolean>;
}
