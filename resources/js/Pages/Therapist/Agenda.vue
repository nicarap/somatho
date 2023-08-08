<script setup>
import TherapistLayout from '@/Layouts/TherapistLayout.vue';
import Agenda from '@/Components/Agenda.vue';
import moment from 'moment/moment';
import Modal from '@/Components/Modal.vue';
import CreateTraitment from '@/Pages/Traitment/Create.vue';
import { ref } from 'vue';

defineProps({
    therapist: {
        type: Object,
    }
})

const openModal = ref(false)
const filters = ref ({})

const openReserveModal = (start_at, end_at, user = null) => {
    console.log(start_at, end_at)
    // if(isReserved(d,h) || isPassed(d)) return false;
    
    // openModal.value = true;
    // filters.value = {
    //     user: user,
    //     start_at: s.start_at,
    //     end_at: h
    // }
    
};

const isPassed = (day) => day.momentDate < moment()

const isReserved = (day, hour) => {
    if (soins.find((s) => 
        moment(day.momentDate.format('DD/MM/YYYY')+' '+hour).isBetween(moment(s.start_at), moment(s.end_at), 'days')
    )) return true;
}


const closeReserveModal = () => {
    openModal.value = false;
};

const soins = [
    {start_at:'2023-08-07 09:30:00', end_at:'2023-08-07 11:30:00', user: {name:'Franky'}},
    {start_at:'2023-08-08 12:45:00', end_at:'2023-08-08 14:00:00', user: {name:'Vicent'}},
    {start_at:'2023-08-08 15:00:00', end_at:'2023-08-08 17:00:00', user: {name:'Barie'}},
    {start_at:'2023-08-09 09:00:00', end_at:'2023-08-09 11:30:00', user: {name:'Estellie'}},
    {start_at:'2023-08-11 09:30:00', end_at:'2023-08-11 11:00:00', user: {name:'Bla'}},
]

const getPosition = (start, end) => {
    let top = 'top-0'
    let minutes = moment(start).minutes()

    switch(minutes){
        case 0: top = 'top-0'; break;
        case 15: top = 'top-1/3'; break;
        case 30: top = 'top-1/2'; break;
        case 45: top = 'top-2/3'; break;
    }
    
    return `${top}`
}

const getHeight = (start, end) => {
    let {hours, minutes } = getDuration(start, end);
    return (hours*3 + (minutes/60)*3) + 'rem'
}

const traitments = (e, soin) => {
    e.stopPropagation
    console.log('soisn ', soin)
}

// h-12 = 3rem
const getDuration = (start, end) => {
    let date_start = moment(start);
    let date_end = moment(end);
    let duration = moment.duration(date_end.diff(date_start))
    
    return {hours : duration.hours(), minutes: duration.minutes()}
}

const getDate = (timestamp, format = 'yyyyMMDD') => {
    let date = moment(timestamp);
    return moment(date).format(format);
}

const getSlotsName = (s) => {
    return getDate(s.start_at) + getDate(s.start_at, 'HH')
}

const createReservation = (form) => {
    console.table(form)
    // form.post(route('traitment.store'))
}

</script>

<template>

<therapist-layout title="Profile" :therapist="therapist">
    <Agenda :therapist="therapist.data" @click="openReserveModal">
        <template v-for="(s, index) in soins" :key="index" v-slot:[getSlotsName(s)]>
            <div class="absolute flex bg-gray-100 hover:bg-cyan-200 z-50 cursor-pointer overflow-hidden rounded-tl-md rounded-bl-md  left-0 right-0 left-0" 
            :class="getPosition(s.start_at, s.end_at)" :style="{height: getHeight(s.start_at, s.end_at)}"
            @click="openReserveModal(moment(s.start_at), moment(s.end_at), s.user)">
                <div class="h-full bg-cyan-400 px-1 " />
                <div class="px-2">
                    <div>{{ s.user?.name }}</div>
                    <div class="text-xs text-gray-500">{{ getDate(s.start_at, 'HH:mm') }} - {{ getDate(s.end_at, 'HH:mm') }}</div>
                </div>
            </div>
        </template> 
    </Agenda>  
    </therapist-layout>

    <Modal :show="openModal" @close="closeReserveModal" maxWidth="sm">
        <create-traitment @submit="createReservation" :therapist="therapist" :filters="filters" @cancel="closeReserveModal" />
    </Modal>

</template>