import { Pago } from './Pago';

export class PagoYape extends Pago {
    constructor(empleado_id: number, monto: number) {
        super(empleado_id, monto, 'yape');
    }

    async procesarPago(): Promise<boolean> {
        try {
            // Simular procesamiento de pago con Yape
            console.log(`Procesando pago Yape para empleado ${this.empleado_id}: $${this.monto}`);

            // Simular delay de procesamiento
            await new Promise(resolve => setTimeout(resolve, 3000));

            this.estado = 'completado';
            console.log('Pago Yape procesado exitosamente');
            return true;
        } catch (error) {
            this.estado = 'fallido';
            console.error('Error procesando pago Yape:', error);
            return false;
        }
    }
}
