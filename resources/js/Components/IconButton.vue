<template>
    <div class="flex justify-center items-center cursor-pointer rounded-full hover:bg-gray-200" :class="computedSize">
        <font-awesome-icon :icon="icon" :size="size" />
    </div>
</template>

<script setup>
import { defineProps, computed } from 'vue';

const props = defineProps({
    icon: {
        type: String,
        default: 'eye'
    },
    size: {
        type: String,
        default: 'sm',
    }
})

const computedSize = computed(() => {
    return {
        'xs' : 'h-4 w-4',
        'sm' : 'h-6 w-6',
        'md' : 'h-8 w-8',
        'lg' : 'h-12 w-12',
    }[props.size]
})


</script>