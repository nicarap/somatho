<script setup>
import Create from '@/Components/Traitment/Create.vue';
import Update from '@/Components/Traitment/Update.vue';
import Complete from '@/Components/Traitment/Complete.vue';
import axios from 'axios';
import { ref, onMounted } from 'vue';

const patients = ref([]);
const therapistAddresses = ref([]);
const patientAddresses = ref([]);

defineEmits(["updateReservation","createReservation", "cancelReservation", "cancel"])

const props = defineProps({
    therapist: {
        type: Object,
        default: () => {}
    },
    traitment: {
        type: Object,
        default: () => {}
    },
    filters: {
        type: Object,
        default: () => {}
    }
})

const getPatient = () => {
    axios(route('api.therapist.patient.index', {therapist: props.therapist}))
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

const patient_id = ref(_.get(props.filters, 'id', null));

onMounted(() => {
    getPatient();
    getTherapistAddress();
})

</script>

<template>
    <template v-if="props.traitment">
        <template v-if="props.traitment.is_passed">
            <div class="p-4 bg-primary text-white uppercase shadow flex w-full items-center justify-between">
                <h1>Réservation passée</h1>
                
                <font-awesome-icon
                icon="check" class="text-white cursor-pointer hover:text-green-500"
                        title="Annuler la réservation" />
            </div>
            

            <complete
                @cancel="() => $emit('cancel')"
                @updateReservation="(f) => $emit('updateReservation', f)"
                @cancelReservation="(f) => $emit('cancelReservation', f)"
                v-bind="{traitment, patients, therapistAddresses, patientAddresses}">
            </complete>

        </template>
        <template v-else>
            <div class="p-4 bg-primary text-white uppercase shadow flex w-full items-center justify-between">
                <h1>Modification de la réservation</h1>
                
                <font-awesome-icon @click="$emit('cancelReservation', traitment)" icon="trash-alt" class="text-white cursor-pointer hover:text-red-700"
                        title="Annuler la réservation" />
            </div>

            <update
                @cancel="() => $emit('cancel')"
                @updateReservation="(f) => $emit('updateReservation', f)"
                @cancelReservation="(f) => $emit('cancelReservation', f)"
                v-bind="{traitment, patients, therapistAddresses, patientAddresses}">
            </update>
        </template>
    </template>
    <template v-else>
        <div class="p-4 bg-primary text-white uppercase shadow">
            <h1>Créer une réservcation</h1>
        </div>

        <create
            @cancel="() => $emit('cancel')"
            @createReservation="(f) => $emit('createReservation', f)"
            @updatePatient="(p) => getPatientAddress(p)"
            v-bind="{filters, patients, therapistAddresses, patientAddresses}">
        </create>
    </template>
</template>