<template>
    <Dialog :open="modelValue" @update:open="$emit('update:modelValue', $event)">
        <DialogContent class="max-w-md">
            <DialogHeader>
                <DialogTitle>Enviar notificación</DialogTitle>
                <DialogDescription> Elige cómo notificar a {{ empleado?.nombre }} sobre su pago procesado </DialogDescription>
            </DialogHeader>

            <div class="space-y-3 py-4">
                <div
                    v-for="tipo in tiposNotificacion"
                    :key="tipo.id"
                    @click="seleccionarTipo(tipo)"
                    class="cursor-pointer rounded-lg border p-4 transition-colors hover:bg-gray-50"
                    :class="{ 'border-green-500 bg-green-50': tipoSeleccionado?.id === tipo.id }"
                >
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-green-100">
                                <span class="font-semibold text-green-600">{{ tipo.icono }}</span>
                            </div>
                            <div>
                                <p class="font-semibold">{{ tipo.nombre }}</p>
                                <p class="text-sm text-gray-500">{{ tipo.descripcion }}</p>
                            </div>
                        </div>
                        <div v-if="tipoSeleccionado?.id === tipo.id" class="text-green-600">✓</div>
                    </div>
                </div>
            </div>

            <DialogFooter>
                <DialogClose as-child>
                    <Button variant="secondary">Cancelar</Button>
                </DialogClose>
                <Button @click="enviarNotificacion" variant="default" :disabled="!tipoSeleccionado || enviando">
                    <span v-if="enviando">Enviando...</span>
                    <span v-else>Enviar notificación</span>
                </Button>
            </DialogFooter>
        </DialogContent>
    </Dialog>
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
import { NotificacionCorreo } from '@/models/notificaciones/NotificacionCorreo';
import { NotificacionSMS } from '@/models/notificaciones/NotificacionSMS';
import type { Empleado } from '@/types/empleado';
import { defineEmits, defineProps, ref } from 'vue';

const props = defineProps<{
    modelValue: boolean;
    empleado: Empleado | null;
    metodoPago: string;
    monto: number;
}>();

const emit = defineEmits<{
    'update:modelValue': [value: boolean];
    notificacionEnviada: [success: boolean, tipo: string];
}>();

const tipoSeleccionado = ref<any>(null);
const enviando = ref(false);

const tiposNotificacion = [
    {
        id: 'sms',
        nombre: 'SMS',
        descripcion: 'Mensaje de texto al celular',
        icono: 'S',
        clase: NotificacionSMS,
    },
    {
        id: 'correo',
        nombre: 'Correo',
        descripcion: 'Email electrónico',
        icono: 'C',
        clase: NotificacionCorreo,
    },
];

const seleccionarTipo = (tipo: any) => {
    tipoSeleccionado.value = tipo;
};

const enviarNotificacion = async () => {
    if (!tipoSeleccionado.value || !props.empleado) return;

    enviando.value = true;

    try {
        const mensaje = `Su pago de $${props.monto.toFixed(2)} ha sido procesado exitosamente con ${props.metodoPago}.`;
        const notificacion = new tipoSeleccionado.value.clase(props.empleado.id, mensaje);
        const resultado = await notificacion.enviarNotificacion();

        emit('notificacionEnviada', resultado, tipoSeleccionado.value.nombre);
        emit('update:modelValue', false);
    } catch (error) {
        console.error('Error enviando notificación:', error);
        emit('notificacionEnviada', false, tipoSeleccionado.value.nombre);
    } finally {
        enviando.value = false;
    }
};
</script>

<style scoped></style>
