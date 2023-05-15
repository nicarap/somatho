<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import moment from 'moment';
import { watch } from 'vue';

const props = defineProps({
    therapist: Object,
    patients: Object,
    filters: Object,
    days: Array,
    hours: Array,
})

const data = {
    day: _.get(props.filters, 'day'),
    start_hour: _.get(props.filters, 'day.momentDate')?.format('YYYY-MM-DD'),
    start_quart: null,
    end_hour: null,
    end_quart: null,
}

const form = useForm({
    therapist_id:props.therapist.id,
    patient_id: null,
    programmed_start_at: moment(_.get(props.filters, 'day.momentDate')?.format('YYYY-MM-DD')+'T'+_.get(props.filters, 'hour'))?.format('YYYY-MM-DD HH:mm'),
    programmed_end_at: moment(_.get(props.filters, 'day.momentDate')?.format('YYYY-MM-DD')+'T'+_.get(props.filters, 'hour'))?.add(2, 'hours').format('YYYY-MM-DD HH:mm'),
    time:''
})

watch(()=>form.programmed_start_at, (val) => {
    form.programmed_end_at = moment(val).add(1.5, 'hours').format('YYYY-MM-DD HH:mm')
})

const emit = defineEmits(['submit', 'cancel'])

const submit = () => {
    emit('submit', form)
}

const cancel = () => emit('cancel')

</script>

<template>
    <form @submit.prevent="submit">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Créer une réservation
            </h2>
            
            <div class="mt-3 w-full"><pre>{{ props.patients?.data }}</pre>
                <InputLabel for="patient" value="Patient" />
                <select id="patient" class="border-gray-300 w-full mt-0 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="form.patient_id">
                    <option v-for="p in props.patients" :value="p.id">{{p.name}}</option>
                </select>
                <InputError :message="form.errors.patient" class="mt-2" />
            </div>

            <div class="mt-3 w-full">
                <InputLabel for="day" value="Jour et heure de début" />
                <TextInput type="datetime-local" class="w-full" :min="moment().format('YYYY-MM-DDThh:mm')" v-model="form.programmed_start_at" />
                <InputError :message="form.errors.programmed_start_at" class="mt-2" />
            </div>

            <div class="mt-3 w-full">
                <InputLabel for="day" value="Jour et heure de fin" />
                <TextInput type="datetime-local" class="w-full" :min="form.programmed_start_at" v-model="form.programmed_end_at" />
                <InputError :message="form.errors.programmed_end_at" class="mt-2" />
            </div>     

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="cancel"> Annuler </SecondaryButton>

                <PrimaryButton
                    class="ml-3"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    @click="createReservation"
                >
                    Reserver
                </PrimaryButton>
            </div>
        </div>
    </form>
</template>