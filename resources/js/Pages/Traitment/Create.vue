<script setup>
import Create from '@/Components/Traitment/Create.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const patients = ref([]);

const getPatient = () => {
    axios(route('api.therapist.patients.index', {therapist: props.therapist}))
    .then((response) => { patients.value = response.data })
}
defineEmits(["updateReservation","createReservation"])
const props = defineProps({
    therapist: {
        type: Object,
        default: () => {}
    },
    filters: {
        type: Object,
        default: () => {}
    }
})

onMounted(() => {
    getPatient()
})

</script>

<template>
    <create 
            @updateReservation="(form) => $emit('updateReservation', form)"
            @createReservation="(form) => $emit('createReservation', form)"
            v-bind="{filters, therapist, patients}" />
</template>