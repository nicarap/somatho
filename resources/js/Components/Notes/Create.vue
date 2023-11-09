<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';

const emits = defineEmits(['updateNote'])

const form = useForm({
    description: ""
});

const updateNote = () => {
    emits("updateNote", form);
}

</script>

<template>
    <div class="mt-3 w-full">
        <InputLabel for="day" value="Note" />
        <textarea row="4" type="text" @change="updateNote" 
            class="w-full border-gray-300 mt-0 focus:border-primary focus:ring-primary rounded-md shadow-sm disabled:bg-gray-100 disabled:text-gray-700"
            v-model="form.description" />
        <InputError :message="form.errors.description" class="mt-2" />
    </div>
</template>