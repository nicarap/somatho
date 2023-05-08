<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";

defineProps({
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
});

</script>

<template>
    <div>
        <InputLabel :for="name" :value="label" />
        <TextInput :id="name" class="mt-1 block w-full" type="text" v-bind="$attrs" />
        <InputError v-for="error in errors" class="mt-2" :message="errors" />
    </div>
</template>
