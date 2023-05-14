<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { defineProps } from 'vue';

defineProps({
    user:{
        type: Object,
        default: () => {}
    }
})
</script>

<template>
    <AuthenticatedLayout>
        {{ user }}
    </AuthenticatedLayout>
</template>