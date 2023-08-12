<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextInputField from '@/Components/TextInputField.vue';
import { Link, useForm } from '@inertiajs/vue3';
import IconButton from '@/Components/IconButton.vue';
import { ref } from 'vue';

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
const profileInformationOpen = ref(false);

const form = useForm({
    name: props.user?.name,
    email: props.user?.email,
});
</script>

<template>
    <div>
        <div class="flex justify-between items-center text-gray-900" @click="profileInformationOpen = !profileInformationOpen">
            <section>
                <header>
                    <h2 class="text-lg font-medium text-gray-900">Mes informations</h2>
                    
                    <p class="text-sm text-gray-600">
                        Update your account's profile information and email address.
                    </p>
                </header>
            </section>
            <icon-button :icon="profileInformationOpen ? 'chevron-up' : 'chevron-down'" />
        </div>

        <form @submit.prevent="form.patch(route('profile.update'))" class="transition-all duration-150 overflow-hidden space-y-6"
        :class="profileInformationOpen ? 'max-h-96' : 'max-h-0'">
            <div class="mt-2">
                <TextInputField label="Nom" 
                    name="name"
                    v-model="form.name" 
                    required 
                    autofocus 
                    autocomplete="name" />

                <div>
                    <InputLabel for="email" value="Email" />

                    <TextInput
                        id="email"
                        type="email"
                        class="mt-1 block w-full"
                        v-model="form.email"
                        required
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

                <div class="flex items-center mt-2 justify-end gap-4">
                    <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                    <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                        <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                    </Transition>
                </div>
            </div>
        </form>
    </div>
</template>
