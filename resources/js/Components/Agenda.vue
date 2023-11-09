<script setup>
import { computed, ref, defineProps, defineEmits } from 'vue';
import IconButton from './IconButton.vue';
import moment from 'moment';

const hours = ref([
    '07:00',
    '08:00',
    '09:00',
    '10:00',
    '11:00',
    '12:00',
    '13:00',
    '14:00',
    '15:00',
    '16:00',
    '17:00',
])

const today = ref(moment())

const props = defineProps({
    numberOfDays: {
        type: String,
        default: '7'
    },
    numWeek: {
        type: Number,
        default: null
    },
    therapist: Object,
    loading: {
        type: Boolean,
        default: false,
    }
})

const displayDay = ref(moment.now())

const emits = defineEmits(['click', 'clickHalf', 'previousWeek', 'nextWeek', 'today'])

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

const isPassed = (date) => {
    return today.value > date
}

const slotName = (momentDate) => {return momentDate?.format('YYYYMMDD')}

const days = computed(() => {
    let gdays = []
    for(let i=0; i<6; i++){
        gdays.push({
            day: moment().startOf('week').week(props.numWeek).add(i+1, 'day').format('dddd'), 
            translate_day: translateDay(moment().startOf('week').week(props.numWeek).add(i+1, 'day').format('dddd')), 
            momentDate: moment().startOf('week').week(props.numWeek).add(i+1, 'day')
        })
    }
    return gdays;
})

const click = (date, hour) => {
    if(!isPassed(date)){
        emits('click', date, hour)
    }
}

const clickHalf = (date, hour) => {
    if(!isPassed(date)){
        emits('clickHalf', date, hour)
    }
}
const month = computed(() => props.numWeek && moment().startOf('week').week(props.numWeek).format('MMMM'))

</script>

<template>
    <div class="relative">
        <table class="w-full">
            <thead>
                <tr><th :colspan="days.length+1" class="text-center p-2 text-gray-600">
                    {{ translateMonth(month) }}
                </th></tr>
                <tr>
                    <th :colspan="days.length+1" class="text-center p-2 text-gray-600">
                        <div class="flex gap-4 w-full justify-center">
                            <icon-button icon="chevron-left"  @click="$emit('previousWeek')"/> 
                            Semaine {{ numWeek }} 
                            <icon-button icon="chevron-right"  @click="$emit('nextWeek')"/>
                        </div>
                        <div class="text-xs" @click="$emit('today')">
                            Aujourd'hui
                        </div>
                    </th>
                </tr>
                <tr class="bg-white">
                    <td class="text-center border border-l-0"></td>
                    <template v-for="(d, index) in days" :key="index">
                        <th  class="p-2 border" v-if="index < props.numberOfDays">
                            <div>{{d.translate_day}}</div>
                            <div class="text-xs text-gray-400">{{d.momentDate.format('DD/MM/YYYY')}}</div>
                        </th>
                    </template>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr v-for="(h, index) in hours" class="m-2 h-12" :key="index">
                    <td class="text-center border h-12 ">{{ h }}</td>
                    
                    <template v-for="(d, indexd) in days" :key="indexd">
                        <td v-if="indexd < props.numberOfDays" :class="[isPassed(d.momentDate) && 'bg-gray-300']" 
                        class="relative ">
                        <!-- v-if="d.momentDate.isSame(displayDay, 'day')"  -->
                            <div class="absolute top-0 bottom-1/2 bg-500 border left-0 right-0" :class="[!isPassed(d.momentDate) && 'hover:bg-gray-100']"  @click="click(d.momentDate, h)" />
                            <div class="absolute top-1/2 bottom-0 bg-500 border left-0 right-0" :class="[!isPassed(d.momentDate) && 'hover:bg-gray-100']"  @click="clickHalf(d.momentDate, h)" />
                            <slot :name="slotName(d.momentDate)+h.split(':')[0]" /> 
                        </td>
                    </template>
                </tr>
            </tbody>
        </table>
        <div v-if="loading" class="absolute top-0 bottom-0 left-0 right-0 w-full flex justify-center items-center bg-gray-300/20">
            <icon-button icon="spinner" class="text-primary animate-spin" size="2xl" />
        </div>
    </div>
</template>