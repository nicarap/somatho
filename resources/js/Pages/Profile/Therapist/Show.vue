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
    {day:'monday', hours:'8', time:'1'},
    {day:'monday', hours:'10', time:'2'},
    {day:'wednesday', hours:'10', halfTime:true, time:'2'},
]

const position = ref('left-0 right-0 left-0');

const getPosition = (item) => {
    console.log(item)

    let top = 'top-0'
    let height = 'h-12';

    if(item.halfTime){
        top = 'top-50'
    }

    if(item.time === '2'){
        height = 'h-24'
    }
    
    return `${height} ${top} left-0 right-0 left-0`
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
            <Agenda>
                <template v-for="s in soins" v-slot:[s.day+s.hours]>
                    <div class="absolute border border-l-4 border-red-400 border-t-0 border-r-0 border-b-0 px-2 bg-gray-100 hover:bg-red-200 z-50 cursor-pointer" :class="getPosition(s)">
                        <div>Soins</div>
                        <div class="text-xs text-gray-500">Patient</div>
                    </div>
                </template> 
            </Agenda>  
        </div>

    </AuthenticatedLayout>
</template>
