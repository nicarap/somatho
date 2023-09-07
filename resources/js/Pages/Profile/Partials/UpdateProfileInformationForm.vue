<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextInputField from '@/Components/TextInputField.vue';
import { Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    user:{
        type: Object,
        default: () => {}
    },
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    name: props.user?.name,
    email: props.user?.email,
});
</script>

<template>
    <div>
        <div class="flex justify-between items-center text-gray-900">
            <section>
                <header>
                    <h2 class="text-lg font-semibold uppercase text-primary">Mes informations</h2>
                </header>
            </section>
        </div>

        <form @submit.prevent="form.patch(route('profile.update'))" class="space-y-6">
            <div class="mt-2 grid grid-cols-2 gap-2">

                <div class="mt-2">
                    <InputLabel for="name" value="Nom" />

                    <TextInput
                        id="name"
                        type="text"
                        class="mt-1 block w-full"
                        v-model="form.name"
                        required
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.name" />
                </div>

                <div class="mt-2">
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        disabled
                        autocomplete="username"
                    />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div v-if="mustVerifyEmail && user.email_verified_at === null">
                    <p class="text-sm mt-2 text-gray-800">
                        Your email address is unverified.
                        <Link
                            :href="route('verification.send')"
                            method="post"
                            as="button"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        >
                            Click here to re-send the verification email.
                        </Link>
                    </p>

                    <div
                        v-show="status === 'verification-link-sent'"
                        class="mt-2 font-medium text-sm text-green-600"
                    >
                        A new verification link has been sent to your email address.
                    </div>
                </div>
            </div>

            <div class="flex items-center mt-2 justify-end w-fullgap-4">
                <PrimaryButton :disabled="form.processing">Enregistrer</PrimaryButton>
            </div>
        </form>
    </div>
</template>
