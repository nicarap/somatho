<script setup>
import Create from '@/Components/Traitment/Create.vue';
import Update from '@/Components/Traitment/Update.vue';
import axios from 'axios';
import { ref, onMounted } from 'vue';

const patients = ref([]);
const therapistAddresses = ref([]);
const patientAddresses = ref([]);

const getPatient = () => {
    axios(route('api.therapist.patients.index', {therapist: props.therapist}))
    .then((response) => { patients.value = response.data })
}

const getTherapistAddress = () => {
    axios(route('api.therapist.address.index', {therapist: props.therapist}))
    .then((response) => { therapistAddresses.value = response.data })
}

const getPatientAddress = (patient) => {
    axios(route('api.patient.address.index', {user: patient}))
    .then((response) => { patientAddresses.value = response.data })
}

defineEmits(["updateReservation","createReservation", "cancelReservation"])

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

const patient_id = ref(_.get(props.filters, 'id', null));

onMounted(() => {
    getPatient();
    getTherapistAddress();
})

</script>

<template>
    <template v-if="!patient_id">
        <create @updateReservation="(f) => $emit('updateReservation', f)"
            @createReservation="(f) => $emit('createReservation', f)"
            v-bind="{filters, therapist, patients, therapistAddresses, patientAddresses}">
        </create>
    </template>
    <template v-else>
        <update 
            @cancelReservation="(f) => $emit('cancelReservation', f)"
            @updatePatient="(p) => getPatientAddress(p)"
            v-bind="{filters, therapist, patients, therapistAddresses, patientAddresses}" >
        </update>
    </template>
</template>