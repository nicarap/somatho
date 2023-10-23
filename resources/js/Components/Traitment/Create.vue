<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import moment from 'moment';
import { computed, watch, ref, onMounted } from 'vue';

const programmed_start_at = ref(null);
const programmed_end_at = ref(null);

const props = defineProps({
    therapist: {type: Object, default: () => {}},
    patients: {type: Object, default: () => {}},
    filters: {type: Object, default: () => {}},
    therapistAddresses: {type: Object, default: () => {}},
    patientAddresses: {type: Object, default: () => {}},
})

const emit = defineEmits(['submit', 'cancel', 'createReservation', 'updateReservation', 'cancelReservation', 'updatePatient'])

const form = useForm({
    id: _.get(props.filters, 'id'),
    therapist_id: props.therapist.id,
    patient_id: _.get(props.filters, 'patient_id'), 
    address_id: _.get(props.filters, 'address_id'),
    programmed_start_at: null,
    programmed_end_at: null,
})

const editMode = computed(() => {
    return form.id
})

onMounted(() => {
    programmed_start_at.value = _.get(props.filters, 'programmed_start_at');
    programmed_end_at.value = _.get(props.filters, 'programmed_end_at');
})

const submit = () => {
    if(editMode.value){
        emit('updateReservation', form)
    }else{
        emit('createReservation', form)
    }
}

const cancel = () => emit('cancel')

if(editMode.value){
    emit('updatePatient', form.patient_id);
}

watch(() => form.patient_id, (val) => emit('updatePatient', val))
watch(() => programmed_start_at.value, (val) => form.programmed_start_at = moment(val).format('YYYY-MM-DD HH:mm'))
watch(() => programmed_end_at.value, (val) => form.programmed_end_at = moment(val).format('YYYY-MM-DD HH:mm'))

</script>

<template>
    <form @submit.prevent="submit">
        <div class="p-6">
            <template v-if="editMode">
                <div class="flex justify-between items-center">
                    <h2 class="text-lg font-medium text-gray-900">
                        Modifier la réservation
                    </h2>
                    <font-awesome-icon @click="$emit('cancelReservation', form)" icon="trash-alt" class="text-red-600 text-opacity-50 cursor-pointer hover:text-opacity-100"
                            title="Annuler la réservation" />
                </div>
            </template>
            <template v-else>
                <h2 class="text-lg font-medium text-gray-900">
                    Créer une réservation
                </h2>
            
            </template>
            
            
            <div class="mt-3 w-full">
                <InputLabel for="patient" value="Patient" />
                <select id="patient" :disabled="editMode" class="border-gray-300 w-full mt-0 focus:border-primary focus:ring-primary rounded-md shadow-sm" 
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

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="cancel"> Annuler </SecondaryButton>

                <PrimaryButton
                    class="ml-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    {{ editMode ? 'Modifier' : 'Reserver' }}
                </PrimaryButton>
            </div>
        </div>
    </form>
</template>