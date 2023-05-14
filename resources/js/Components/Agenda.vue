<script setup>
import { onMounted, ref, useSlots, nextTick } from 'vue';
import moment from 'moment';
import 'moment/locale/fr'
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Modal.vue';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from './PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const days = ref([]);
const hours = ref(['8','9','10','11','12','13','14','15','16','17'])
const openModal = ref(false)
const slots = useSlots()

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
    form.hour = h
    nextTick(() => console.log('passwordInput.value.focus()'));
};

const closeReserveModal = () => {
    openModal.value = false;

    form.reset();
};

const form = useForm({
    day:'',
    hour:'',
    halfTime:'',
    time:'1'
})

const isReserved = (days, hour) => {
    return slots[days.day.toLowerCase()+hour]
}

const getDays = () => {
    let gdays = []

    for(let i=0; i<6; i++){
        gdays.push({
            day: moment().startOf('week').day(i+1).format('dddd'), 
            translate_day: translateDay(moment().startOf('week').day(i+1).format('dddd')), 
            formated: moment().startOf('week').day(i+1).format('DD/MM/YYYY')})
    }
    days.value = gdays;
}

onMounted(() => {
    getDays()
})

const createReservation = () => {
    console.log(form)
}

</script>

<template>
    <table class="w-full">
        <thead>
            <th v-for="d in ['', ...days]" class="p-2 border">
                <div>{{d.translate_day}}</div>
                <div class="text-xs text-gray-400">{{d.formated}}</div>
            </th>
        </thead>
        <tbody>
            <tr v-for="h in hours" class="m-2 h-12 border-b">
                <td class="border text-center">{{ h }}h</td>
                <td v-for="d in days" class="border relative" :class="[!isReserved(d, h) && 'hover:bg-gray-100']" @click="openReserveModal(d,h)">
                    <div class="absolute top-[50%] border-dashed  border-t right-0 left-0" />
                    <slot :name="d.day.toLowerCase()+h" />
                </td>
            </tr>
        </tbody>
    </table>

    <Modal :show="openModal" @close="closeReserveModal" maxWidth="sm">
        <div class="p-6">
            <h2 class="text-lg font-medium text-gray-900">
                Créer une réservation
            </h2>
            <div class="mt-6 w-full">
                <InputLabel for="day" value="Jour" class="sr-only" />
                <select id="day" class="border-gray-300 w-full mt-0 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="form.day">
                    <option v-for="d in days" :value="d.day">{{d.translate_day}}</option>
                </select>
                <InputError :message="form.errors.day" class="mt-2" />
            </div>

            <div class="mt-6 w-full flex">
                <InputLabel for="hour" value="Heure de début" class="sr-only" >Heure de début</InputLabel>
                <select id="hour" class="border-gray-300 w-full mt-0 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="form.hour">
                    <option v-for="h in hours" :value="h">{{h}}h</option>
                </select>
                <InputError :message="form.errors.day" class="mt-2" />

                <InputLabel for="hour" value="Heure de début" class="sr-only" >Heure de début</InputLabel>
                <select id="hour" class="border-gray-300  mt-0 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" v-model="form.halfTime">
                    <option :value="null">00</option>
                    <option v-for="h in ['30']" :value="true">{{h}}</option>
                </select>
                <InputError :message="form.errors.day" class="mt-2" />
            </div>

            <div class="mt-6 w-full">
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