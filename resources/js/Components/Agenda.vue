<script setup>
import { computed, ref } from 'vue';
import IconButton from './IconButton.vue';
import moment from 'moment';

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
    loading: {
        type: Boolean,
        default: false,
    }
})

const emits = defineEmits(['click', 'previousWeek', 'nextWeek', 'today'])

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

const days = computed(() => {
    let gdays = {}
    for(let i=0; i<6; i++){
        let date = moment().startOf('week').week(props.numWeek).add(i+1, 'day');
        gdays[date] = []
        for(let j=0; j<23; j++){
            gdays[date].push(moment().startOf('week').week(props.numWeek).add(i+1, 'day').set('hour', 7).set('minute', j*30))
        }
    }
    return gdays;
})

const month = computed(() => props.numWeek && moment().startOf('week').week(props.numWeek).format('MMMM'))

const click = (date) => {
    emits('click', date)
}

</script>

<template>
    
    <!-- <tr><th :colspan="days.length+1" class="text-center p-2 text-gray-600">
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
                </tr> -->

    <div class="relative flex flex-col h-full">
        <div class="w-full text-center py-2">
            <span>{{ translateMonth(month) }}</span>
            <div class="flex gap-4 w-full justify-center">
                <icon-button icon="chevron-left"  @click="$emit('previousWeek')"/> 
                Semaine {{ numWeek }} 
                <icon-button icon="chevron-right"  @click="$emit('nextWeek')"/>
            </div>
            <div class="text-xs" @click="$emit('today')">
                Aujourd'hui
            </div>
        </div>

        <div class="flex gap-2 w-full">
            <div class="w-20"></div>
            <div class="flex gap-2 grow">
                <div v-for="(key, value) in days" class="flex-1 text-center">
                    {{ translateDay(moment(value).format("dddd")) }}
                    <div class="text-xs text-gray-400" >{{ moment(value).format("DD/MM/YYYY") }}</div>
                </div>
            </div>
        </div>

        <div class="flex  gap-2 h-full w-full flex-1">
            <div class="flex flex-col w-20 ">
                <template v-for="(h) in days[Object.keys(days)[0]]">
                    <div class="even:hidden grow flex items-center justify-center">
                        {{ h.format('HH:mm') }}
                    </div>
                </template>
            </div>

            <div v-for="(key, value) in days" class="flex-1 border-2 rounded-xl overflow-hidden  flex flex-col">
                <div class="flex flex-col grow">
                    <div class="grow flex flex-col" v-for="(h, index) in key">
                        <div class="grow relative" @click="click(h)" :class="[isPassed(h) ? 'bg-gray-300':  'bg-white', index % 2 && 'border-b-2']">
                            <slot :name="h.format('YYYYMMDDHHmm')" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>