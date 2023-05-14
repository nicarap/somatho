<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';

defineProps({
    'patient': {
        type: Object,
        default: () => {}
    }
})
</script>

<template>
    <Head title="Patient" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <pre>{{patient}}</pre>
        </div>
    </AuthenticatedLayout>
</template>