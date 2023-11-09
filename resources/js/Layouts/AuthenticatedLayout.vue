<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100 h-[10%]">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 h-16 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-full">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <ApplicationLogo
                                        class="block h-12 w-auto fill-primary text-gray-800"
                                    />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden h-18 bg-gray-500 relative text-white z-50"
                >
                    <div class="space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('therapist.dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('therapist.agenda', {
                            therapist: $page.props.auth.user
                        })" :active="route().current('therapist.agenda')">
                            Agenda
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('therapist.patient.index', {
                            therapist: $page.props.auth.user
                        })" :active="route().current('therapist.patient.*')">
                            Patients
                        </ResponsiveNavLink>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main class="h-[90%] flex w-full">
                <div class="h-full hidden lg:block bg-white w-full max-w-xs shadow-xl">
                    <div v-if="$slots.avatar || $slots.navigation" class="w-full max-w-xs bg-white rounded-lg shadow max-h-full flex flex-col">
                        <div class="flex flex-col items-center m-2">
                            <slot name="avatar" />
                        </div>
                        <div class="w-full overflow-y-auto">
                            <slot name="navigation" />
                        </div>
                    </div>
                </div>

                <div class="w-full py-8 sm:px-6 lg:px-8 h-full overflow-hidden">
                    <div class="flex gap-4 w-full items-start h-full overflow-hidden">
                        <div class="flex-1 px-2 h-full overflow-auto">
                            <slot />
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>
