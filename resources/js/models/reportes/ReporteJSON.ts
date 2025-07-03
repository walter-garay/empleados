import type { IReporte } from '../../interfaces/IReporte';

export class ReporteJSON implements IReporte {
    generar_reporte(data: any[]): void {
        const json = JSON.stringify(data, null, 2);
        const now = new Date();
        const fecha = now.toISOString().replace(/[:.]/g, '-').slice(0, 19);
        const filename = `reporte-empleados-${fecha}.json`;
        const blob = new Blob([json], { type: 'application/json' });
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
