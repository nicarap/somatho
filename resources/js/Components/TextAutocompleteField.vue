<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import Dropdown from "./Dropdown.vue";
import { ref, watch } from "vue";
const emit = defineEmits(['search', 'update:modelValue']);

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
        default: () => null
    },
    modelValue: {
        type: Object,
        default: null
    },
    value: {
        type: String,
        default: ''
    },
    valueKey: {
        type: String,
        default: 'properties.label',
    },
    items: {
        type: Array,
        default: () => []
    },
    loading: {
        type: Boolean,
        default: false,
    },
    disabled: {
        type: Boolean,
        default: false,
    }
});

const value = ref(props.value)
const choose = (item) => emit('update:modelValue', item)

watch(() => props.modelValue, (val) => value.value = props.value)

const dropdown = ref(null)

watch(value, (val) => {
    dropdown.value.open = true
    emit('search', val)
})


</script>

<template>
    <div>
        <InputLabel :for="name" :value="label" />
        <Dropdown ref="dropdown" width="full" :disabled="disabled">
            <template #trigger>
                <div class="relative">
                    <TextInput :id="name" class="pr-8 mt-1 block w-full" type="text" autocomplete="off" :disabled="disabled" v-bind="$attrs" v-model="value" />
                    <div class="absolute top-0 right-0 h-full w-8 flex justify-center items-center">
                        <font-awesome-icon v-if="loading" icon="spinner" class="text-primary animate-spin" />
                    </div>
                </div>
            </template>

            <template #content>
                <template v-if="items.length > 0">
                    <div v-for="(item, index) in items" :key="index" @click="choose(item)" class="p-2 hover:bg-primary/10">
                        <span>{{ item.properties?.label }}</span>
                        <span> - </span>
                        <span>{{ item.properties?.context }}</span>
                    </div>
                </template>
                <div class="p-2 text-gray-500" v-else-if="loading">Chargement en cours...</div>
                <div class="p-2 text-gray-500" v-else-if="errors?.length > 0">Une erreur est survenue...</div>
                <div class="p-2 text-gray-500" v-else>Ecrivez votre adresse...</div>
            </template>
        </Dropdown>
        <InputError v-for="(error, index) in (errors)" :key="index" class="mt-2" :message="error" />
    </div>
</template>
