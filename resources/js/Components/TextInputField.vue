<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import { ref, watch } from "vue";

const emit = defineEmits(['update:modelValue']);

const props = defineProps({
    name: {
        type: String,
    },
    label: {
        type: String,
        required: true,
    },
    errors: {
        type: Array,
        default: () => []
    },
    modelValue: {
        type: String,
        default: ''
    }
});

const value = ref(props.modelValue)

watch(value,(val) => emit('update:modelValue', val))

</script>

<template>
    <div>
        <InputLabel :for="name" :value="label" />
        <TextInput :id="name" class="mt-1 block w-full" type="text" v-bind="$attrs" v-model="value" />
        <InputError v-for="(error, index) in (errors)" :key="index" class="mt-2" :message="errors" />
    </div>
</template>
