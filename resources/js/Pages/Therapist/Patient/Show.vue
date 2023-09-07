<script setup>
import TherapistLayout from '@/Layouts/TherapistLayout.vue';
import TraitmentIndex from "@/Components/Traitment/Index.vue"
import Avatar from '@/Components/Avatar.vue';

const props = defineProps({
    therapist: {
        type: Object,
        default: () => {}
    },
    patient: {
        type: Object,
        default: () => {}
    },
    traitments: {
        type: Object,
        default: () => {}
    }
})
</script>

<template>
    <therapist-layout :therapist="therapist.data">
        <div class="flex w-full justify-between">
            <h1 class="text-2xl uppercase font-semibold text-primary">{{ patient.data.name }}</h1>
        </div>
                    <Avatar size="24" :name="patient.data.name.split(' ').map((s) => s[0]?.toUpperCase?.()).join('')" class=" my-3" />
        <div class="text-sm text-gray-500">{{ patient.data.birthdate }}</div>
        <div class="text-sm text-gray-500">{{ patient.data.email }}</div>
        <div class="text-sm text-gray-500">{{ patient.data.tel }}</div>
        <input type="text" class="text-sm text-gray-500" :value="patient.data.tel">

        <pre>{{ patient.data }}</pre>   

        <ul>
            <li>
                Fiche patient
            </li>
            <li>
                Notes du therapeute
            </li>
            <li>
                Index des traitments recu et a venir
            </li>
        </ul>
        <div class="bg-white p-2 rounded">
            <TraitmentIndex :traitments="traitments?.data" />
        </div>
    </therapist-layout>
</template>