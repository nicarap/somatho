<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import Avatar from '@/Components/Avatar.vue';
import { Head, usePage } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const user = usePage().props.auth.user;

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
            <template #avatar>
                <Avatar size="24" name="RL" class=" my-3" />
                <h5 class="mb-1 text-xl font-medium text-gray-900">{{ user.name }}</h5>
                <span class="text-sm text-gray-500">{{ user.email }}</span>
            </template>

            <template #navigation>
                <div class="mt-4">
                    <div class="bg-teal-600 text-white font-bold p-2">Mon Agenda</div>
                    <ol class="w-full cursor-default">
                        <li class="border pl-8 py-2 text-sm font-medium  hover:bg-gray-200 ">Mes rendez-vous</li>
                        <li class="border pl-8 py-2 text-sm font-medium  hover:bg-gray-200 ">Je prends rendez-vous</li>
                    </ol>
                </div>
                <div class="mt-4">
                    <div class="bg-teal-600 text-white font-bold p-2">Notifications</div>
                    <ol class="w-full cursor-default">
                        <li class="border pl-8 py-2 text-sm font-medium  hover:bg-gray-200 ">Messages</li>
                    </ol>
                </div>
            </template>
            
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <UpdateProfileInformationForm
                    :must-verify-email="mustVerifyEmail"
                    :status="status"
                    class="max-w-xl"
                />
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <UpdatePasswordForm class="max-w-xl" />
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <DeleteUserForm class="max-w-xl" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
