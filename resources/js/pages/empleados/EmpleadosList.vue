<template>
    <div class="mx-auto mt-8 max-w-4xl p-6">
        <Card>
            <CardHeader>
                <CardTitle>Lista de Empleados</CardTitle>
                <CardDescription>Visualiza todos los empleados registrados en el sistema.</CardDescription>
            </CardHeader>
            <CardContent>
                <div class="mb-4 flex gap-2">
                    <Button @click="generarExcel" variant="secondary">Reporte Excel</Button>
                    <Button @click="generarPDF" variant="destructive">Reporte PDF</Button>
                    <Button @click="generarJSON" variant="default">Reporte JSON</Button>
                </div>
                <div v-if="loading">
                    <Skeleton class="mb-2 h-8 w-full" />
                    <Skeleton class="mb-2 h-8 w-full" />
                    <Skeleton class="mb-2 h-8 w-full" />
                </div>
                <div v-else>
                    <div v-if="empleados.length === 0" class="py-8 text-center text-gray-500">No hay empleados registrados.</div>
                    <div v-else class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <Card v-for="empleado in empleados" :key="empleado.id" class="border border-gray-200 shadow-sm transition hover:shadow-md">
                            <CardHeader>
                                <CardTitle>{{ empleado.nombre }}</CardTitle>
                                <CardDescription>DNI: {{ empleado.dni }}</CardDescription>
                            </CardHeader>
                            <CardContent>
                                <div class="flex flex-col gap-1">
                                    <div><span class="font-semibold">ID:</span> {{ empleado.id }}</div>
                                    <div><span class="font-semibold">Fecha de Ingreso:</span> {{ empleado.fecha_ingreso }}</div>
                                    <div>
                                        <span class="font-semibold">Tipo:</span> <span class="capitalize">{{ empleado.tipo.replace('_', ' ') }}</span>
                                    </div>
                                </div>
                                <Button class="mt-4 w-full" variant="outline" @click="abrirSalarioModal(empleado)">Calcular salario</Button>
                            </CardContent>
                        </Card>
                    </div>
                </div>
            </CardContent>
        </Card>
        <SalarioModal v-model="modalAbierto" :empleado="empleadoSeleccionado" />
    </div>
</template>

<script lang="ts" setup>
import Button from '@/components/ui/button/Button.vue';
import Card from '@/components/ui/card/Card.vue';
import CardContent from '@/components/ui/card/CardContent.vue';
import CardDescription from '@/components/ui/card/CardDescription.vue';
import CardHeader from '@/components/ui/card/CardHeader.vue';
import CardTitle from '@/components/ui/card/CardTitle.vue';
import Skeleton from '@/components/ui/skeleton/Skeleton.vue';
import { ReporteExcel } from '@/models/reportes/ReporteExcel';
import { ReporteJSON } from '@/models/reportes/ReporteJSON';
import { ReportePDF } from '@/models/reportes/ReportePDF';
import SalarioModal from '@/pages/empleados/components/SalarioModal.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import type { Empleado } from '../../types/empleado';

const empleados = ref<Empleado[]>([]);
const loading = ref<boolean>(true);
const modalAbierto = ref(false);
const empleadoSeleccionado = ref<Empleado | null>(null);

const fetchEmpleados = async () => {
    try {
        const response = await axios.get<Empleado[]>('/api/empleados?with=salarios');
        console.log('Respuesta de empleados con salarios:', response.data);
        empleados.value = response.data;
    } catch {
        empleados.value = [];
    } finally {
        loading.value = false;
    }
};

const generarExcel = () => {
    const reporte = new ReporteExcel();
    reporte.generar_reporte(empleados.value);
};

const generarPDF = async () => {
    const reporte = new ReportePDF();
    await reporte.generar_reporte(empleados.value);
};

const generarJSON = () => {
    const reporte = new ReporteJSON();
    reporte.generar_reporte(empleados.value);
};

function abrirSalarioModal(empleado: Empleado) {
    empleadoSeleccionado.value = empleado;
    modalAbierto.value = true;
}

onMounted(() => {
    fetchEmpleados();
});
</script>

<style scoped></style>
