<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import CreateNotes from "@/Components/Notes/Create.vue";
import SecondaryButton from '@/Components/SecondaryButton.vue';
import IconButton from '../IconButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import moment from 'moment';
import { watch, ref, onMounted } from 'vue';

const programmed_start_at = ref("");
const programmed_end_at = ref("");

const updateNote = (note) => {
    form.note = note;
}

const props = defineProps({
    patients: {type: Object, default: () => {}},
    filters: {type: Object, default: () => {}},
    therapistAddresses: {type: Object, default: () => {}},
    patientAddresses: {type: Object, default: () => {}},
})

const emit = defineEmits(['cancel', 'createReservation', 'updatePatient'])

const form = useForm({
    id: _.get(props.filters, 'id'),
    patient_id: _.get(props.filters, 'patient_id'), 
    address_id: _.get(props.filters, 'address_id'),
    programmed_start_at: "",
    programmed_end_at: "",
    note: "",
})

onMounted(() => {
    programmed_start_at.value = _.get(props.filters, 'programmed_start_at');
    programmed_end_at.value = _.get(props.filters, 'programmed_end_at');
})

const submit = () => emit('createReservation', form);

const cancel = () => emit('cancel')

watch(() => form.patient_id, (val) => emit('updatePatient', val))
watch(() => programmed_start_at.value, (val) => form.programmed_start_at = moment(val).format('YYYY-MM-DD HH:mm'))
watch(() => programmed_end_at.value, (val) => form.programmed_end_at = moment(val).format('YYYY-MM-DD HH:mm'))

</script>

<template>
    <form @submit.prevent="submit">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Créer une réservation
            </h2>
            
            <div class="mt-3 w-full">
                <InputLabel for="patient" value="Patient" />
                <select id="patient" class="border-gray-300 w-full mt-0 focus:border-primary focus:ring-primary rounded-md shadow-sm" 
                required v-model="form.patient_id">
                    <option v-for="(p, index) in props.patients" :key="index" :value="p.id">{{p.name}}</option>
                </select>
                <InputError :message="form.errors.patient" class="mt-2" />
            </div>

            <div class="mt-3 w-full">
                <InputLabel for="day" value="Début de la réservation" />
                <TextInput type="datetime-local" class="w-full" :min="moment().format('YYYY-MM-DDTHH:mm')" 
                required v-model="programmed_start_at" />
                <InputError :message="form.errors.programmed_start_at" class="mt-2" />
            </div>
            
            <div class="mt-3 w-full">
                <InputLabel for="day" value="Fin de la réservation" />
                <TextInput type="datetime-local" class="w-full"
                    :min="moment(programmed_start_at).startOf('day').format('YYYY-MM-DDTHH:mm')" 
                    :max="moment(programmed_start_at).endOf('day').format('YYYY-MM-DDTHH:mm')"
                    required v-model="programmed_end_at" />
                <InputError :message="form.errors.programmed_end_at" class="mt-2" />
            </div>   
            
            <div class="mt-3 w-full">
                <InputLabel for="day" value="Adresse" />
                <select :disabled="therapistAddresses.length === 0 && patientAddresses.length === 0" id="address" 
                class="border-gray-300 w-full mt-0 focus:border-primary focus:ring-primary rounded-md shadow-sm" 
                    required v-model="form.address_id">
                    <optgroup label="Mes adresses">
                        <option v-for="address in therapistAddresses" :value="address.id">{{ address.name }}</option>
                    </optgroup>
                    <optgroup v-if="patientAddresses.length > 0" label="Adresses du patient">
                        <option v-for="address in patientAddresses"  :value="address.id">{{ address.name }}</option>
                    </optgroup>
                </select>
                <InputError :message="form.errors.adress_id" class="mt-2" />
            </div>     
            <div class="mt-2">
                <create-notes @updateNote="updateNote" />
            </div>

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="cancel"> Annuler </SecondaryButton>

                <PrimaryButton
                    class="ml-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Reserver
                </PrimaryButton>
            </div>
        </div>
    </form>
</template>