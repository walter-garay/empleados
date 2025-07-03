<template>
    <Dialog :open="modelValue" @update:open="$emit('update:modelValue', $event)">
        <DialogContent class="max-w-md">
            <DialogHeader>
                <DialogTitle>Salario actual</DialogTitle>
                <DialogDescription> Se ha calculado correctamente su salario: </DialogDescription>
            </DialogHeader>
            <div class="py-4">
                <div class="text-center">
                    <p class="text-lg font-semibold">{{ empleado?.nombre }}</p>
                    <p class="text-gray-500">DNI: {{ empleado?.dni }}</p>
                    <p class="text-gray-500 capitalize">Tipo: {{ empleado?.tipo.replace('_', ' ') }}</p>
                    <div class="mt-4 rounded-lg bg-green-50 p-3">
                        <p class="text-2xl font-bold text-green-600">${{ salarioCalculado.toFixed(2) }}</p>
                        <p class="text-sm text-green-500">Salario calculado</p>
                    </div>
                </div>
            </div>
            <DialogFooter>
                <DialogClose as-child>
                    <Button variant="secondary">Cancelar</Button>
                </DialogClose>
                <Button @click="abrirPagoModal" variant="default">Pagar</Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>

    <PagoModal v-model="pagoModalAbierto" :empleado="empleado" :monto="salarioCalculado" @pago-completado="onPagoCompletado" />
</template>

<script lang="ts" setup>
import PagoModal from '@/pages/empleados/components/PagoModal.vue';
import Button from '@/components/ui/button/Button.vue';
import Dialog from '@/components/ui/dialog/Dialog.vue';
import DialogClose from '@/components/ui/dialog/DialogClose.vue';
import DialogContent from '@/components/ui/dialog/DialogContent.vue';
import DialogDescription from '@/components/ui/dialog/DialogDescription.vue';
import DialogFooter from '@/components/ui/dialog/DialogFooter.vue';
import DialogHeader from '@/components/ui/dialog/DialogHeader.vue';
import DialogTitle from '@/components/ui/dialog/DialogTitle.vue';
import { EmpleadoContratista } from '@/models/empleados/EmpleadoContratista';
import { EmpleadoTiempoCompleto } from '@/models/empleados/EmpleadoTiempoCompleto';
import { EmpleadoTiempoParcial } from '@/models/empleados/EmpleadoTiempoParcial';
import type { Empleado } from '@/types/empleado';
import { computed, defineEmits, defineProps, ref } from 'vue';

const props = defineProps<{
    modelValue: boolean;
    empleado: Empleado | null;
}>();

const emit = defineEmits<{
    'update:modelValue': [value: boolean];
}>();

const pagoModalAbierto = ref(false);

const salarioCalculado = computed(() => {
    if (!props.empleado) return 0;

    let empleadoCalculado;

    switch (props.empleado.tipo) {
        case 'tiempo_completo':
            empleadoCalculado = new EmpleadoTiempoCompleto(props.empleado);
            break;
        case 'medio_tiempo':
            empleadoCalculado = new EmpleadoTiempoParcial(props.empleado);
            break;
        case 'contratista':
            empleadoCalculado = new EmpleadoContratista(props.empleado);
            break;
        default:
            return 0;
    }

    return empleadoCalculado.calcularSalario();
});

const abrirPagoModal = () => {
    pagoModalAbierto.value = true;
};

const onPagoCompletado = (success: boolean, metodo: string) => {
    if (success) {
        console.log(`Pago completado exitosamente con ${metodo}`);
        emit('update:modelValue', false);
    } else {
        console.log(`Error en el pago con ${metodo}`);
    }
};
</script>

<style scoped></style>
