import { Pago } from './Pago';

export class PagoTarjeta extends Pago {
    constructor(empleado_id: number, monto: number) {
        super(empleado_id, monto, 'tarjeta');
    }

    async procesarPago(): Promise<boolean> {
        try {
            // Simular procesamiento de pago con Tarjeta
            console.log(`Procesando pago Tarjeta para empleado ${this.empleado_id}: $${this.monto}`);

            // Simular delay de procesamiento
            await new Promise((resolve) => setTimeout(resolve, 5000));

            this.estado = 'completado';
            console.log('Pago Tarjeta procesado exitosamente');
            return true;
        } catch (error) {
            this.estado = 'fallido';
            console.error('Error procesando pago Tarjeta:', error);
            return false;
        }
    }
}
