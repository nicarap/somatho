<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import Avatar from '@/Components/Avatar.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';


defineProps({
    therapist: {
        type: Object,
    },
});

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #avatar>
            <Avatar size="24" :name="therapist.data.name.split(' ').map((s) => s[0]?.toUpperCase?.()).join('')" class=" my-3" />
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
                    <li class="border pl-8 py-2 text-sm font-medium  hover:bg-gray-200" 
                    @click="$inertia.get(route('profile.therapist.agenda', therapist.data))">Mes rendez-vous</li>
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
            <!-- TODO  -->
            <ul>
            <li>Stats nb patients</li>
            <li>patients de la journée / de deamain</li>
            <li>patients / jours</li>
        </ul>
        </div>

    </AuthenticatedLayout>
</template>
