<script setup>
import { useForm } from '@inertiajs/vue3';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import CreateAddress from "@/Components/Address/Create.vue"

defineProps({
    users: Array,
});

const emit = defineEmits('submitForm', 'cancel');

const form = useForm({
    name: null, 
    email: null,
})

const submit = () => emit('submitForm', form);
const cancel = () => emit('cancel');

</script>

<template>
    <form @submit.prevent="submit">
        <div class="flex gap-2">
            <div class="grow">
                <InputLabel for="name" value="Nom" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="grow">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="email"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>
        </div>

        <div>
                <CreateAddress 
                    @save="createNewAddress"
                    @cancel="closeAddNewAddressModal" :user="user">
                </CreateAddress>
        </div>
        <div>Créer Adresse </div>
        <div>telephone</div>

        <div class="flex items-center justify-end mt-4">
            <SecondaryButton @click="cancel" type="button">
                Annuler
            </SecondaryButton>
            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Créer
            </PrimaryButton>
        </div>
    </form>
</template>