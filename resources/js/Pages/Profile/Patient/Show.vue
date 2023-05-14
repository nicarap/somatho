<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Avatar from '@/Components/Avatar.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    patient: {
        type: Object,
    },
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #avatar>
            <Avatar size="24" name="RL" class=" my-3" />
            <h5 class="mb-1 text-xl font-medium text-gray-900">{{ patient.data.name }}</h5>
            <span class="text-sm text-gray-500">{{ patient.data.email }}</span>
            <div class="p-4">
                <PrimaryButton @click="$inertia.visit(route('profile.edit', patient))">Modifier mes informations</PrimaryButton>
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

        <div class="bg-white shadow-sm rounded-md p-4">
            <div>Afficher :</div><p>mes soins à venir</p>
            <p>Mes contacts</p>
            <p>Mon practicient</p>

            <pre>{{ patient }}</pre>
        </div>           
    </AuthenticatedLayout>
</template>
