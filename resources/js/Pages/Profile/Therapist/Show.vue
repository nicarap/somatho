<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import Avatar from '@/Components/Avatar.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Agenda from '@/Components/Agenda.vue';


defineProps({
    therapist: {
        type: Object,
    },
});

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
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #avatar>
            <Avatar size="24" name="RL" class=" my-3" />
            <h5 class="mb-1 text-xl font-medium text-gray-900">{{ therapist.data.name }}</h5>
            <span class="text-sm text-gray-500">{{ therapist.data.email }}</span>
            <div class="p-4">
                <PrimaryButton @click="$inertia.visit(route('profile.edit', therapist))">Modifier mes informations</PrimaryButton>
            </div>
        </template>

        <template #navigation>
            <div class="mt-4">
                <div class="bg-teal-600 text-white font-bold p-2">Mon Agenda</div>
                <ol class="w-full cursor-default">
                    <li class="border pl-8 py-2 text-sm font-medium  hover:bg-gray-200 ">Mes rendez-vous</li>
                    <li class="border pl-8 py-2 text-sm font-medium  hover:bg-gray-200 ">Je prends rendez-vous</li>
                </ol>
            </div>
            <div class="mt-4">
                <div class="bg-teal-600 text-white font-bold p-2">Notifications</div>
                <ol class="w-full cursor-default">
                    <li class="border pl-8 py-2 text-sm font-medium  hover:bg-gray-200 ">Messages</li>
                </ol>
            </div>
        </template>

        
        <div class="bg-white">
            <Agenda :traitments="soins">
                <template v-for="s in soins" v-slot:[s.day+s.start_hour]>
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
        </div>

    </AuthenticatedLayout>
</template>
