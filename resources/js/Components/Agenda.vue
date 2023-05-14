<script setup>
import { onMounted, ref, useSlots, nextTick, watch, defineProps } from 'vue';
import moment from 'moment';
import 'moment/locale/fr'
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from './PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

const days = ref([]);
const hours = ref([
    '08:00', '08:15', '08:30', '08:45',
    '09:00', '09:15', '09:30', '09:45',
    '10:00', '10:15', '10:30', '10:45',
    '11:00', '11:15', '11:30', '11:45',
    '12:00', '12:15', '12:30', '12:45',
    '13:00', '13:15', '13:30', '13:45',
    '14:00', '14:15', '14:30', '14:45',
    '15:00', '15:15', '15:30', '15:45',
    '16:00', '16:15', '16:30', '16:45',
    '17:00', '17:15', '17:30', '17:45',
])
const openModal = ref(false)
const slots = useSlots()
const numWeek = ref(moment().format('W'))

const props = defineProps({
    dislayDay: {
        type: String,
        default: '7'
    }
})

const translateDay = (day) => {
    return {
        'Monday': 'Lundi',
        'Tuesday': 'Mardi',
        'Wednesday': 'Mercredi',
        'Thursday': 'Jeudi',
        'Friday': 'Vendredi',
        'Saturday': 'Samedi'
    }[day]
}

const openReserveModal = (d, h) => {
    if(isReserved(d,h)) return false;
    
    openModal.value = true;
    form.day = d.day
    form.start_hour = h
    // nextTick(() => console.log('passwordInput.value.focus()'));
};

const closeReserveModal = () => {
    openModal.value = false;

    form.reset();
};

const form = useForm({
    day: null,
    start_hour: null,
    start_quart: null,
    end_hour: null,
    end_quart: null,
    time:'1'
})

const isReserved = (days, hour) => {
    return slots[days.formated_en+hour]
}

const getDays = () => {
    let gdays = []
    for(let i=0; i<6; i++){
        gdays.push({
            day: moment().startOf('week').week(numWeek.value).add(i+1, 'day').format('dddd'), 
            translate_day: translateDay(moment().startOf('week').week(numWeek.value).add(i+1, 'day').format('dddd')), 
            formated: moment().startOf('week').week(numWeek.value).add(i+1, 'day').format('DD/MM/YYYY'),
            formated_en: moment().startOf('week').week(numWeek.value).add(i+1, 'day').format('YYYYMMDD')})
    }
    days.value = gdays;
    console.log(numWeek)
}

onMounted(() => {
    getDays()
})

watch(numWeek, () => {
    getDays()
})

const createReservation = () => {
    console.log(form)
}

</script>

<template>
    <table class="w-full">
        <thead>
            <tr><th :colspan="days.length+1" class="text-center p-2 text-gray-600">
                <FontAwesomeIcon icon="chevron-left" class="text-gray-400" @click="numWeek--"/> Semaine {{ numWeek }} <FontAwesomeIcon icon="chevron-right" class="text-gray-400" @click="numWeek++" />
            </th></tr>
            <tr>
                <td class="text-center border-r">{{ h }}</td>
                <template v-for="(d, index) in days" >
                
                    <th  class="p-2 border" v-if="index < props.dislayDay">
                        <div>{{d.translate_day}}</div>
                        <div class="text-xs text-gray-400">{{d.formated}}</div>
                    </th>
                </template>
            </tr>
        </thead>
        <tbody>
            <tr v-for="h in hours.filter((h) => h.includes(':00'))" class="m-2 h-12 border-b">
                <td class="text-center border-r">{{ h }}</td>
                
                <template v-for="(d, index) in days" >
                    <td v-if="index < props.dislayDay">
                        <div :class="[!isReserved(d, h) && 'hover:bg-gray-100']" @click="openReserveModal(d,h)">
                            <div  class="relative h-3"><slot :name="d.formated_en+h" /></div>
                            <div class="relative h-3 border-dashed border-b right-0 left-0"><slot :name="d.formated_en+h.replace(':00', ':15')" /></div>
                        </div>
                        <div :class="[!isReserved(d, h) && 'hover:bg-gray-100']" @click="openReserveModal(d,hours[hours.indexOf(h)+2])">
                            <div class="relative h-3"><slot :name="d.formated_en+h.replace(':00', ':30')" /></div>
                            <div class="relative h-3"><slot :name="d.formated_en+h.replace(':00', ':45')" /></div>
                        </div>
                    </td>
                </template>
            </tr>
        </tbody>
    </table>

    <Modal :show="openModal" @close="closeReserveModal" maxWidth="sm">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Créer une réservation
            </h2>
            <div class="mt-3 w-full">
                <InputLabel for="day" value="Jour" class="sr-only" />
                <select id="day" class="border-gray-300 w-full mt-0 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="form.day">
                    <option v-for="d in days" :value="d.day">{{d.translate_day}}</option>
                </select>
                <InputError :message="form.errors.day" class="mt-2" />
            </div>

        <div class="mt-3 w-full flex">
            <InputLabel for="hour" value="Heure de début" class="sr-only" >Heure de début</InputLabel>
            <select id="hour" class="border-gray-300 w-full mt-0 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="form.start_hour">
                <option v-for="h in hours.filter((h) => h >= form.start_hour)" :value="h">{{h}}</option>
            </select>
            <InputError :message="form.errors.day" class="mt-2" />
        </div>

        <div class="mt-3 w-full flex">
            <InputLabel for="hour" value="Heure de début" class="sr-only" >Heure de Fin</InputLabel>
            <select id="hour" class="border-gray-300 w-full mt-0 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="form.end_hour">
                <option v-for="h in hours.filter((h) => h >= form.start_hour)" :value="h">{{h}}</option>
            </select>
            <InputError :message="form.errors.day" class="mt-2" />
        </div>

            <div class="mt-3 w-full">
                <InputLabel for="time" value="Durée" class="sr-only" />
                <TextInput id="time" type="number" min="1" max="3" class="border-gray-300 w-full mt-0 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="form.time" />
                <InputError :message="form.errors.day" class="mt-2" />
            </div>           

            <div class="mt-6 flex justify-end">
                <SecondaryButton @click="closeReserveModal"> Annuler </SecondaryButton>

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
    
    </Modal>
</template>