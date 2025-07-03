import type { IReporte } from '../../interfaces/IReporte';

export class ReportePDF implements IReporte {
    generar_reporte(data: any[]): void {
        let contenido = 'Lista de empleados\n\n';
        if (data.length === 0) {
            contenido += 'No hay empleados para mostrar.';
        } else {
            data.forEach((empleado, idx) => {
                contenido += `Empleado #${idx + 1}\n`;
                Object.entries(empleado).forEach(([key, value]) => {
                    if (Array.isArray(value)) return; // Ignorar relaciones
                    contenido += `  ${key}: ${value}\n`;
                });
                contenido += '\n';
            });
        }
        const now = new Date();
        const fecha = now.toISOString().replace(/[:.]/g, '-').slice(0, 19);
        const filename = `reporte-empleados-${fecha}.pdf`;
        const blob = new Blob([contenido], { type: 'application/pdf' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.href = url;
        link.download = filename;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        URL.revokeObjectURL(url);
    }
}
