import type { IPago } from '../../interfaces/IPago';

export abstract class Pago implements IPago {
    id?: number;
    empleado_id: number;
    monto: number;
    metodo_pago: string;
    fecha_pago: string;
    estado: string;

    constructor(empleado_id: number, monto: number, metodo_pago: string) {
        this.empleado_id = empleado_id;
        this.monto = monto;
        this.metodo_pago = metodo_pago;
        this.fecha_pago = new Date().toISOString();
        this.estado = 'pendiente';
    }

    abstract procesarPago(): Promise<boolean>;
}
