import { Empleado } from './Empleado';

export class EmpleadoTiempoCompleto extends Empleado {
    constructor(empleado: any) {
        super(empleado);
        this.tipo = 'tiempo_completo';
    }

    calcularSalario(): number {
        // Empleados de tiempo completo reciben salario completo
        if (this.salarios && this.salarios.length > 0) {
            return this.salarios.reduce((total, salario) => total + salario.monto, 0);
        }
        // Salario base para tiempo completo si no hay salarios registrados
        return 3000;
    }
}
