<script setup>
import TherapistLayout from '@/Layouts/TherapistLayout.vue';
import DeleteUserForm from '../Profile/Partials/DeleteUserForm.vue';
import UpdatePasswordForm from '../Profile/Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from '../Profile/Partials/UpdateProfileInformationForm.vue';
import Avatar from '@/Components/Avatar.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    therapist:{
        type: Object,
    },
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const profileInformationOpen = ref(false)
</script>

<template>
    <therapist-layout :therapist="therapist" title="Modification">            
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateProfileInformationForm
                        :user="therapist.data"
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                    />
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <UpdatePasswordForm />
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <DeleteUserForm />
            </div>
        </div>
    </therapist-layout>
</template>
