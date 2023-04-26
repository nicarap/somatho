<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">You're logged in!</div>
                    <div class="flex gap-2 m-2">
                        <button class="border p-2 rounded hover:bg-gray-500 hover:text-slate-300" @click="$inertia.visit(route('patient.index'))">Patients</button>
                        <button class="border p-2 rounded hover:bg-gray-500 hover:text-slate-300" @click="$inertia.visit(route('therapist.index'))">therapist</button>
                        <button class="border p-2 rounded hover:bg-gray-500 hover:text-slate-300" @click="$inertia.visit(route('therapist.patient.index'))">Mes patients</button>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
