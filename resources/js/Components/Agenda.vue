<script setup>
import { onMounted, ref, useSlots, nextTick, watch, defineProps } from 'vue';
import Modal from '@/Components/Modal.vue';
import CreateTraitment from '@/Pages/Traitment/Create.vue';
import moment from 'moment';

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
const today = ref(moment())
const numWeek = ref(null)
const month = ref(null)
const createTraitment = ref(null)
const filters = ref({})

const props = defineProps({
    dislayDay: {
        type: String,
        default: '7'
    },
    therapist: Object,
})

const translateMonth = (month) => {
    return {
        'January': 'Janvier',
        'February': 'Février',
        'March': 'Mars',
        'April': 'Avril',
        'May': 'Mai',
        'June': 'Juin',
        'July': 'Juilliet',
        'August': 'Août',
        'September': 'Septembre',
        'October': 'Octobre',
        'November': 'Novembre',
        'December': 'Décembre',
    }[month]
}

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
    if(isReserved(d,h) || isPassed(moment(d.momentDate, 'DD/MM/YYYY'))) return false;
    
    openModal.value = true;
    filters.value = {
        day: d,
        hour: h
    }
    // nextTick(() => console.log('passwordInput.value.focus()'));
};

const closeReserveModal = () => {
    openModal.value = false;
};

const isReserved = (days, hour) => {
    return slots[slotName(days.momentDate)+hour]
}

const slotName = (momentDate) => {return momentDate.format('YYYYMMDD')}

const getDays = () => {
    let gdays = []
    for(let i=0; i<6; i++){
        gdays.push({
            day: moment().startOf('week').week(numWeek.value).add(i+1, 'day').format('dddd'), 
            translate_day: translateDay(moment().startOf('week').week(numWeek.value).add(i+1, 'day').format('dddd')), 
            momentDate: moment().startOf('week').week(numWeek.value).add(i+1, 'day')
        })
    }
    days.value = gdays;
}

const getMonth = () => {
    month.value = moment().startOf('week').week(numWeek.value).format('MMMM')
}

const getWeek = () => numWeek.value = moment().format('W')
const isPassed = (date) => {return today.value > date}
const isHoverableCell = (date, hour) => { return !isReserved(date, hour) && !isPassed(date.momentDate) }
onMounted(() => {
    getWeek();
})

watch(numWeek, () => {
    getDays();
    getMonth();
})

const createReservation = (form) => {
    console.table(form)
    // form.post(route('traitment.store'))
}

</script>

<template>
    <table class="w-full">
        <thead>
            <tr><th :colspan="days.length+1" class="text-center p-2 text-gray-600">
                {{ translateMonth(month) }}
            </th></tr>
            <tr><th :colspan="days.length+1" class="text-center p-2 text-gray-600">
                <font-awesome-icon icon="chevron-left" class="text-gray-400" @click="numWeek--"/> Semaine {{ numWeek }} <font-awesome-icon icon="chevron-right" class="text-gray-400" @click="numWeek++" />
            </th></tr>
            <tr>
                <td class="text-center border-r">{{ h }}</td>
                <template v-for="(d, index) in days" >
                    <th  class="p-2 border" v-if="index < props.dislayDay">
                        <div>{{d.translate_day}}</div>
                        <div class="text-xs text-gray-400">{{d.momentDate.format('DD/MM/YYYY')}}</div>
                    </th>
                </template>
            </tr>
        </thead>
        <tbody>
            <tr v-for="h in hours.filter((h) => h.includes(':00'))" class="m-2 h-12 border-b">
                <td class="text-center border-r">{{ h }}</td>
                
                <template v-for="(d, index) in days" >
                    <td v-if="index < props.dislayDay" :class="[isPassed(d.momentDate) && 'bg-gray-300']">
                        <div :class="[isHoverableCell(d,h) && 'hover:bg-gray-100']" @click="openReserveModal(d,h)">
                            <div  class="relative h-3"><slot :name="slotName(d.momentDate)+h" /></div>
                            <div class="relative h-3 border-dashed border-b right-0 left-0"><slot :name="slotName(d.momentDate)+h.replace(':00', ':15')" /></div>
                        </div>
                        <div :class="[isHoverableCell(d, h) && 'hover:bg-gray-100']" @click="openReserveModal(d,hours[hours.indexOf(h)+2])">
                            <div class="relative h-3"><slot :name="slotName(d.momentDate)+h.replace(':00', ':30')" /></div>
                            <div class="relative h-3"><slot :name="slotName(d.momentDate)+h.replace(':00', ':45')" /></div>
                        </div>
                    </td>
                </template>
            </tr>
        </tbody>
    </table>

    <Modal :show="openModal" @close="closeReserveModal" maxWidth="sm">
        <create-traitment ref="createTraitment" @submit="createReservation" :therapist="therapist" :filters="filters" @cancel="closeReserveModal" />
    
    </Modal>
</template>