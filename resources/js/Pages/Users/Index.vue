<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { defineProps } from 'vue';
import userIndex from '@/Components/User/Index.vue';

defineProps({
    users: {
        type: Array,
        default: () => []
    }
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="px-2">
            <userIndex :users="users.data" />
        </div>
    </AuthenticatedLayout>
</template>