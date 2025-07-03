import type { IEmpleado, Salario } from '../../interfaces/IEmpleado';

export abstract class Empleado implements IEmpleado {
    id: number;
    dni: string;
    nombre: string;
    fecha_ingreso: string;
    tipo: string;
    salarios?: Salario[];
    reportes?: any[];
    notificaciones?: any[];

    constructor(empleado: IEmpleado) {
        this.id = empleado.id;
        this.dni = empleado.dni;
        this.nombre = empleado.nombre;
        this.fecha_ingreso = empleado.fecha_ingreso;
        this.tipo = empleado.tipo;
        this.salarios = empleado.salarios;
        this.reportes = empleado.reportes;
        this.notificaciones = empleado.notificaciones;
    }

    // Método abstracto que debe ser implementado por las clases hijas
    abstract calcularSalario(): number;
}
