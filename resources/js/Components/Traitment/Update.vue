<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    therapist: {type:Object, default: () => {}},
    patients: {type: Object, default: () => {}},
    traitment: {type: Object, default: () => {}},
})

const emit = defineEmits(['cancel', 'updateReservation'])

const form = useForm({
    therapist_id:  _.get(props.traitment, 'therapist_id'),
    patient_id: _.get(props.traitment, 'patient_id'), 
    address_id: _.get(props.traitment, 'address_id'),
    programmed_start_at: _.get(props.traitment, 'programmed_start_at'),
    programmed_end_at: _.get(props.traitment, 'programmed_end_at'),
})

const cancel = () => emit('cancel')
const submit = () => emit('updateReservation', form);

const therapistAddresses = computed(() => {
    return props.therapist.addresses;
})

const patientAddresses = computed(() => {
    return form.patient_id ? props.patients.find((p) => p.id === form.patient_id).addresses : [];
})

</script>

<template>
    <form @submit.prevent="submit">
        <div class="p-6">            
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
                    v-model="form.programmed_start_at" />
            </div>
            
            <div class="mt-3 w-full">
                <InputLabel for="day" value="Fin de la réservation" />
                <TextInput type="datetime-local" class="w-full"
                    v-model="form.programmed_end_at" />
            </div>   
            
            <div class="mt-3 w-full">
                <InputLabel for="day" value="Adresse" />
                <select id="address" 
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
            
            <div class="mt-3 w-full">
                <InputLabel value="Notes" />
                <div class="space-y-1">
                    <div v-for="note in traitment.notes" class="bg-gray-200 rounded-md p-2">
                        {{ note.description }}
                    </div>  
                </div>
            </div> 


            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="cancel"> Annuler </SecondaryButton>
                <PrimaryButton
                    class="ml-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Modifier
                </PrimaryButton>
            </div>
        </div>
    </form>
</template>