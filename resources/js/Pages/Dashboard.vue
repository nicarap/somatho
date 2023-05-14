<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import Avatar from '@/Components/Avatar.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

defineProps({
    user: {
        type: Object,
        default: () => {}
    }
})

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #avatar>
            <Avatar size="24" name="RL" class=" my-3" />
            <h5 class="mb-1 text-xl font-medium text-gray-900">{{ user.data.name }}</h5>
            <span class="text-sm text-gray-500">{{ user.data.email }}</span>
            <span class="text-sm text-gray-500">{{ user.data.roles.map((r) => r.name).join(', ') }}</span>
            <div class="p-4">
                <PrimaryButton @click="$inertia.visit(route('profile.edit', user.data))">Modifier mes informations</PrimaryButton>
            </div>
        </template>

        <template #navigation>
            <div class="mt-4">
                <ol class="w-full cursor-default">
                    <li class="border p-2 text-sm font-medium hover:bg-gray-200" @click="$inertia.get(route('user.index'))">Utilisateurs</li>
                    <li class="border p-2 text-sm font-medium hover:bg-gray-200" @click="$inertia.get(route('user.index'))">Log Applicatifs</li>
                </ol>
            </div>
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">You're logged in!</div>
        <pre>{{ user }}</pre>
            <div class="flex gap-2 m-2">
                <button class="border p-2 rounded hover:bg-gray-500 hover:text-slate-300" @click="$inertia.visit(route('patient.index'))">Patients</button>
                <button class="border p-2 rounded hover:bg-gray-500 hover:text-slate-300" @click="$inertia.visit(route('therapist.index'))">therapist</button>
                <button class="border p-2 rounded hover:bg-gray-500 hover:text-slate-300" @click="$inertia.visit(route('therapist.patient.index'))">Mes patients</button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
