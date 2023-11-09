<script setup>
import Complete from '@/Components/Traitment/Complete.vue';

const props = defineProps({
    traitment: {
        type: Object,
        default: () => {}
    }
})
</script>

<template>
    <div class="p-4 bg-primary text-white uppercase shadow flex w-full items-center justify-between">
        <h1>Réservation passée</h1>
        
        <font-awesome-icon @click="$emit('cancelReservation', traitment)" icon="trash-alt" class="text-white cursor-pointer hover:text-red-700"
                title="Annuler la réservation" />
    </div>

    <complete
        @cancel="() => $emit('cancel')"
        @updateReservation="(f) => $emit('validateReservation', f)"
        @cancelReservation="(f) => $emit('cancelReservation', f)"
        v-bind="{traitment, patients, therapistAddresses, patientAddresses}">
    </complete>
</template>