<template>
    <therapist-layout
        title="Profile"
        :therapist="therapist.data"
    >

        <div class="flex w-full justify-between">
            <h1 class="text-2xl uppercase font-semibold text-primary">Mes patients</h1>
            <PrimaryButton @click="$inertia.visit(route('therapist.patient.create', {therapist: therapist.data}))">
                <div class="flex gap-2 items-center">
                    <font-awesome-icon icon="plus" />
                    <span> Ajouter un patient</span>
                </div>
            </PrimaryButton>
        </div>
        
        <div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 mt-4">
            <div v-for="(patient, index) in therapist.data.patients" :key="index" 
            class="bg-white border shadow-sm p-4 mb-2" 
            @click="patientSelected = patient">        
                <div class="w-full flex justify-center">
                    <Avatar size="24" :name="patient.name.split(' ').map((s) => s[0]?.toUpperCase?.()).join('')" class=" my-3" />
                </div>
                <div class="block text-xl font-medium text-gray-900">{{ patient.name }}</div>
                <div class="text-sm text-gray-500">{{ patient.email }}</div>
                <div class="text-sm text-gray-500">Dernier rendez vous </div>
                <div class="text-sm text-gray-500">Prochain rendez vous </div>
                <div class="pt-4 w-full flex justify-end">
                    <SecondaryButton @click="$inertia.visit(route('therapist.patient.show', {therapist: therapist.data, patient: patient}))">Voir la fiche</SecondaryButton>
                </div>
            </div>
        </div>
    </therapist-layout>
</template>

<script>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Avatar from '@/Components/Avatar.vue';
import TherapistLayout from '@/Layouts/TherapistLayout.vue';
export default {
    name: 'index',
    components: {
        TherapistLayout, Avatar, SecondaryButton, PrimaryButton
    },
    props:{
        therapist:{
            type: Object,
            default: () => null,
        }
    },
    data(){
        return{
            patientSelected: null,
        }
    }
}
</script>