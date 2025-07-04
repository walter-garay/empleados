<template>
    <Dialog :open="modelValue" @update:open="$emit('update:modelValue', $event)">
        <DialogContent class="max-w-md">
            <DialogHeader>
                <DialogTitle>Seleccionar método de pago</DialogTitle>
                <DialogDescription> Elige cómo quieres procesar el pago de ${{ monto.toFixed(2) }} para {{ empleado?.nombre }} </DialogDescription>
            </DialogHeader>

            <div v-if="!pagoCompletado" class="space-y-3 py-4">
                <div
                    v-for="metodo in metodosPago"
                    :key="metodo.id"
                    @click="seleccionarMetodo(metodo)"
                    class="cursor-pointer rounded-lg border p-4 transition-colors hover:bg-gray-50"
                    :class="{ 'border-blue-500 bg-blue-50': metodoSeleccionado?.id === metodo.id }"
                >
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100">
                                <span class="font-semibold text-blue-600">{{ metodo.icono }}</span>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-400">{{ metodo.nombre }}</p>
                                <p class="text-sm text-gray-500">{{ metodo.descripcion }}</p>
                            </div>
                        </div>
                        <div v-if="metodoSeleccionado?.id === metodo.id" class="text-blue-600">✓</div>
                    </div>
                </div>
            </div>

            <div v-else class="py-4 text-center">
                <div class="mb-4 rounded-lg bg-green-50 p-3">
                    <p class="font-semibold text-green-600">¡Pago procesado exitosamente!</p>
                    <p class="text-sm text-green-500">Método: {{ metodoCompletado }}</p>
                </div>
                <Button @click="abrirNotificacionModal" variant="default" class="w-full"> Notificar al empleado </Button>
            </div>

            <DialogFooter v-if="!pagoCompletado">
                <DialogClose as-child>
                    <Button variant="secondary">Cancelar</Button>
                </DialogClose>
                <Button @click="procesarPago" variant="default" :disabled="!metodoSeleccionado || procesando">
                    <span v-if="procesando">Procesando...</span>
                    <span v-else>Procesar pago</span>
                </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>

    <NotificacionModal
        v-model="notificacionModalAbierto"
        :empleado="empleado"
        :metodo-pago="metodoCompletado"
        :monto="monto"
        @notificacion-enviada="onNotificacionEnviada"
    />
    <div v-if="notificacionResultado" class="mt-4 text-center">
        <div
            :class="{
                'bg-green-100 text-green-700': notificacionResultado.success,
                'bg-red-100 text-red-700': !notificacionResultado.success,
            }"
            class="rounded p-3"
        >
            <span v-if="notificacionResultado.success"> ✅ Notificación {{ notificacionResultado.tipo }} enviada exitosamente. </span>
            <span v-else> ❌ Error enviando notificación {{ notificacionResultado.tipo }}. </span>
        </div>
    </div>
</template>

<script lang="ts" setup>
import Button from '@/components/ui/button/Button.vue';
import Dialog from '@/components/ui/dialog/Dialog.vue';
import DialogClose from '@/components/ui/dialog/DialogClose.vue';
import DialogContent from '@/components/ui/dialog/DialogContent.vue';
import DialogDescription from '@/components/ui/dialog/DialogDescription.vue';
import DialogFooter from '@/components/ui/dialog/DialogFooter.vue';
import DialogHeader from '@/components/ui/dialog/DialogHeader.vue';
import DialogTitle from '@/components/ui/dialog/DialogTitle.vue';
import { PagoPaypal } from '@/models/pagos/PagoPaypal';
import { PagoTarjeta } from '@/models/pagos/PagoTarjeta';
import { PagoYape } from '@/models/pagos/PagoYape';
import type { Empleado } from '@/types/empleado';
import { defineEmits, defineProps, ref, watch } from 'vue';
import NotificacionModal from './NotificacionModal.vue';

const props = defineProps<{
    modelValue: boolean;
    empleado: Empleado | null;
    monto: number;
}>();

const emit = defineEmits<{
    'update:modelValue': [value: boolean];
    pagoCompletado: [success: boolean, metodo: string];
}>();

const metodoSeleccionado = ref<any>(null);
const procesando = ref(false);
const pagoCompletado = ref(false);
const metodoCompletado = ref('');
const notificacionModalAbierto = ref(false);
const notificacionResultado = ref<null | { success: boolean; tipo: string }>(null);

const metodosPago = [
    {
        id: 'yape',
        nombre: 'Yape',
        descripcion: 'Transferencia instantánea',
        icono: 'Y',
        clase: PagoYape,
    },
    {
        id: 'paypal',
        nombre: 'PayPal',
        descripcion: 'Pago electrónico seguro',
        icono: 'P',
        clase: PagoPaypal,
    },
    {
        id: 'tarjeta',
        nombre: 'Tarjeta',
        descripcion: 'Débito o crédito',
        icono: 'T',
        clase: PagoTarjeta,
    },
];

const seleccionarMetodo = (metodo: any) => {
    metodoSeleccionado.value = metodo;
};

const procesarPago = async () => {
    if (!metodoSeleccionado.value || !props.empleado) return;

    procesando.value = true;

    try {
        const pago = new metodoSeleccionado.value.clase(props.empleado.id, props.monto);
        const resultado = await pago.procesarPago();

        if (resultado) {
            pagoCompletado.value = true;
            metodoCompletado.value = metodoSeleccionado.value.nombre;
        }

        emit('pagoCompletado', resultado, metodoSeleccionado.value.nombre);
    } catch (error) {
        console.error('Error procesando pago:', error);
        emit('pagoCompletado', false, metodoSeleccionado.value.nombre);
    } finally {
        procesando.value = false;
    }
};

const abrirNotificacionModal = () => {
    notificacionModalAbierto.value = true;
};

const onNotificacionEnviada = (success: boolean, tipo: string) => {
    notificacionResultado.value = { success, tipo };
    if (success) {
        console.log(`Notificación ${tipo} enviada exitosamente`);
    } else {
        console.log(`Error enviando notificación ${tipo}`);
    }
};

watch(
    () => [props.empleado, props.modelValue],
    () => {
        metodoSeleccionado.value = null;
        procesando.value = false;
        pagoCompletado.value = false;
        metodoCompletado.value = '';
        notificacionModalAbierto.value = false;
        notificacionResultado.value = null;
    },
);
</script>

<style scoped></style>
