<script setup>
import TherapistLayout from '@/Layouts/TherapistLayout.vue';
import Agenda from '@/Components/Agenda.vue';

defineProps({
    therapist: {
        type: Object,
    }
})

const soins = [
    {day:'20230510', start_hour:'08:30', end_hour: '09:00', time:'1'},
    {day:'20230513', start_hour:'10:30', end_hour: '12:00', time:'2'},
    {day:'20230509', start_hour:'10:00', end_hour: '11:00', time:'2'},
]

const getPosition = (item) => {
    let top = 'top-0'
    let height = 'h-12';

    switch(item.start_quart){
        case '0': top = 'top-0';
        case '1': top = 'top-25';
        case '2': top = 'top-25';
        case '3': top = 'top-75';
    }

    if(item.time === '2'){
        height = 'h-24'
    }
    
    return `${height} ${top} left-0 right-0 left-0`
}

const traitments = (e) => {
    e.preventDefault();
    
    console.log(e)
}
</script>

<template>

<therapist-layout title="Profile" :therapist="therapist">
    <Agenda :traitments="soins" :therapist="therapist.data">
        <template v-for="(s, index) in soins" :key="index" v-slot:[s.day+s.start_hour]>
            <div class="absolute flex bg-gray-100 hover:bg-red-200 z-50 cursor-pointer overflow-hidden rounded-tl-md rounded-bl-md" 
            :class="getPosition(s)" @click="traitments">
                <div class="h-full bg-red-400 px-1 " />
                <div class="px-2">
                    <div>Patient Name</div>
                    <div class="text-xs text-gray-500">{{ s.start_hour }}</div>
                </div>
            </div>
        </template> 
    </Agenda>  
    </therapist-layout>
</template>