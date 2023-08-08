<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import moment from 'moment';
import { computed } from 'vue';

const props = defineProps({
    therapist: {type: Object, default: () => {}},
    patients: {type: Object, default: () => {}},
    filters: {type: Object, default: () => {}},
})

const form = useForm({
    patient_id: _.get(props.filters, 'patient_id'),
    programmed_start_at: _.get(props.filters, 'programmed_start_at'),
    programmed_end_at: _.get(props.filters, 'programmed_end_at'),
})

const emit = defineEmits(['submit', 'cancel', 'createReservation', 'updateReservation'])

const submit = () => {
    if(editMode.value){
        emit('updateReservation', form)
    }else{
        emit('createReservation', form)
    }
}

const editMode = computed(() => {
    return form.patient_id && !form.isDirty
})

const cancel = () => emit('cancel')
</script>

<template>
    <form @submit.prevent="submit">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                {{ editMode ? 'Modifier la réservation' : 'Créer une réservation' }}
            </h2>
            
            <div class="mt-3 w-full">
                <InputLabel for="patient" value="Patient" />
                <select id="patient" :disabled="editMode" class="border-gray-300 w-full mt-0 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                required v-model="form.patient_id">
                    <option v-for="p in props.patients" :value="p.id">{{p.name}}</option>
                </select>
                <InputError :message="form.errors.patient" class="mt-2" />
            </div>

            <div class="mt-3 w-full">
                <InputLabel for="day" value="Début de la réservation" />
                <TextInput type="datetime-local" class="w-full" :min="moment().format('YYYY-MM-DDThh:mm')" 
                required v-model="form.programmed_start_at" />
                <InputError :message="form.errors.programmed_start_at" class="mt-2" />
            </div>

            <div class="mt-3 w-full">
                <InputLabel for="day" value="Fin de la réservation" />
                <TextInput type="datetime-local" class="w-full" :min="form.programmed_start_at" 
                required v-model="form.programmed_end_at" />
                <InputError :message="form.errors.programmed_end_at" class="mt-2" />
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