<script setup>
import { defineProps, computed } from "vue";

const props = defineProps({
    name: {
        type: String,
        default: undefined
    },
    img: {
        type: String,
        default: undefined
    },
    size: {
        type: String,
        default: '24'
    }
})

const computedSizeClass = computed(() => {
   return {
        '8': 'w-8 h-8',
        '10': 'w-10 h-10',
        '11': 'w-11 h-11',
        '12': 'w-12 h-12',
        '14': 'w-14 h-14',
        '16': 'w-16 h-16',
        '20': 'w-20 h-20',
        '24': 'w-24 h-24',
    }[props.size]
})
</script>

<template>
    <div  class="relative inline-flex items-center h- justify-center overflow-hidden bg-gray-100 rounded-full  shadow-lg"  :class="[computedSizeClass]">
        <span v-if="props.name" class="font-large text-gray-600">{{ props.name }}</span>
        <font-awesome-icon v-else icon="user" class="absolute -bottom-2 w-full h-full text-gray-400" />
    </div>
</template>