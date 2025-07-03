import { Empleado } from './Empleado';

export class EmpleadoContratista extends Empleado {
    constructor(empleado: any) {
        super(empleado);
        this.tipo = 'contratista';
    }

    calcularSalario(): number {
        // Contratistas reciben salario por proyecto (más alto pero sin beneficios)
        if (this.salarios && this.salarios.length > 0) {
            const salarioTotal = this.salarios.reduce((total, salario) => total + salario.monto, 0);
            return salarioTotal * 1.2; // 20% más por ser contratista
        }
        // Salario base para contratista si no hay salarios registrados
        return 4000;
    }
}
