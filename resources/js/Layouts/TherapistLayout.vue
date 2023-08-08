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
    title: {
        type: String,
        default: 'Thérapeute'
    }
});

</script>

<template>

    <AuthenticatedLayout>
        <Head :title="title" />

        <template #avatar>
            <Avatar size="24" :name="therapist.name.split(' ').map((s) => s[0]?.toUpperCase?.()).join('')" class=" my-3" />
            <h5 class="mb-1 text-xl font-medium text-gray-900">{{ therapist.name }}</h5>
            <span class="text-sm text-gray-500">{{ therapist.email }}</span>
            <div class="p-4">
                <PrimaryButton @click="$inertia.visit(route('therapist.edit', {therapist: therapist}))">Modifier mes informations</PrimaryButton>
            </div>
        </template>

        <template #navigation>
            <div class="mt-4">
                <div class="bg-teal-600 text-white font-bold p-2">Mon Agenda</div>
                <ol class="w-full cursor-default">
                    <li class="border pl-8 pr-2 py-2 text-sm font-medium cursor-pointer hover:bg-gray-200" 
                    @click="$inertia.get(route('therapist.agenda', therapist))">Mes rendez-vous</li>
                    <li class="border pl-8 pr-2 py-2 text-sm font-medium cursor-pointer hover:bg-gray-200 ">Je prends rendez-vous</li>
                </ol>
            </div>
            <div class="mt-4">
                <div class="bg-teal-600 text-white font-bold p-2">Notifications</div>
                <ol class="w-full cursor-default">
                    <li class="border pl-8 pr-2 py-2 text-sm font-medium cursor-pointer flex justify-between hover:bg-gray-200 ">Messages 
                        <div class="h-6 w-6 text-xs rounded-full bg-gray-200 flex items-center justify-center">2</div>
                    </li>
                </ol>
            </div>
        </template>

        <slot />

    </AuthenticatedLayout>
</template>
