import type { IReporte } from '../../interfaces/IReporte';

export class ReporteExcel implements IReporte {
    generar_reporte(data: any[]): void {
        import('xlsx').then((XLSX) => {
            const worksheet = XLSX.utils.json_to_sheet(data);
            const workbook = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(workbook, worksheet, 'Empleados');
            const now = new Date();
            const fecha = now.toISOString().replace(/[:.]/g, '-').slice(0, 19);
            const filename = `reporte-empleados-${fecha}.xlsx`;
            const excelBuffer = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });
            const blob = new Blob([excelBuffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement('a');
            link.href = url;
            link.download = filename;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
            URL.revokeObjectURL(url);
        });
    }
}
