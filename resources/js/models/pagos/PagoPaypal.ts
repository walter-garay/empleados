import { Pago } from './Pago';

export class PagoPaypal extends Pago {
    constructor(empleado_id: number, monto: number) {
        super(empleado_id, monto, 'paypal');
    }

    async procesarPago(): Promise<boolean> {
        try {
            // Simular procesamiento de pago con PayPal
            console.log(`Procesando pago PayPal para empleado ${this.empleado_id}: $${this.monto}`);

            // Simular delay de procesamiento
            await new Promise((resolve) => setTimeout(resolve, 2500));

            this.estado = 'completado';
            console.log('Pago PayPal procesado exitosamente');
            return true;
        } catch (error) {
            this.estado = 'fallido';
            console.error('Error procesando pago PayPal:', error);
            return false;
        }
    }
}
