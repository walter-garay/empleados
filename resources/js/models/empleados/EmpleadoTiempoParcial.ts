import { Empleado } from './Empleado';

export class EmpleadoTiempoParcial extends Empleado {
    constructor(empleado: any) {
        super(empleado);
        this.tipo = 'medio_tiempo';
    }

    calcularSalario(): number {
        // Empleados de medio tiempo reciben la mitad del salario
        if (this.salarios && this.salarios.length > 0) {
            const salarioTotal = this.salarios.reduce((total, salario) => total + salario.monto, 0);
            return salarioTotal * 0.5;
        }
        // Salario base para medio tiempo si no hay salarios registrados
        return 1500;
    }
}
