<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    therapist: {type: Object, default: () => {}},
    patients: {type: Object, default: () => {}},
    filters: {type: Object, default: () => {}},
    therapistAddresses: {type: Object, default: () => {}},
    patientAddresses: {type: Object, default: () => {}},
})

const emit = defineEmits(['cancel', 'updateReservation'])

const form = useForm({
    id: _.get(props.filters, 'id'),
    therapist_id: props.therapist.id,
    patient_id: _.get(props.filters, 'patient_id'), 
    address_id: _.get(props.filters, 'address_id'),
    programmed_start_at: _.get(props.filters, 'programmed_start_at'),
    programmed_end_at: _.get(props.filters, 'programmed_end_at'),
})

const cancel = () => emit('cancel')

</script>

<template>
    <form @submit.prevent="submit">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Modifier la réservation
            </h2>
            
            <div class="mt-3 w-full">
                <InputLabel for="patient" value="Patient" />
                <select id="patient" class="border-gray-300 w-full mt-0 focus:border-primary focus:ring-primary rounded-md shadow-sm" 
                    disabled v-model="form.patient_id">
                    <option v-for="(p, index) in props.patients" :key="index" :value="p.id">{{p.name}}</option>
                </select>
            </div>

            <div class="mt-3 w-full">
                <InputLabel for="day" value="Début de la réservation" />
                <TextInput type="datetime-local" class="w-full"
                    disabled v-model="form.programmed_start_at" />
            </div>
            
            <div class="mt-3 w-full">
                <InputLabel for="day" value="Fin de la réservation" />
                <TextInput type="datetime-local" class="w-full"
                    disabled v-model="form.programmed_end_at" />
            </div>   
            
            <div class="mt-3 w-full">
                <InputLabel for="day" value="Adresse" />
                <select disabled id="address" 
                    class="border-gray-300 w-full mt-0 focus:border-primary focus:ring-primary rounded-md shadow-sm" 
                    required v-model="form.address_id">
                    <optgroup label="Mes adresses">
                        <option v-for="address in therapistAddresses" :value="address.id">{{ address.name }}</option>
                    </optgroup>
                    <optgroup v-if="patientAddresses.length > 0" label="Adresses du patient">
                        <option v-for="address in patientAddresses"  :value="address.id">{{ address.name }}</option>
                    </optgroup>
                </select>
            </div>     

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="cancel"> Annuler </SecondaryButton>
            </div>
        </div>
    </form>
</template>