<script setup>
import TherapistLayout from '@/Layouts/TherapistLayout.vue';
import TraitmentIndex from "@/Components/Traitment/Index.vue"
import Avatar from '@/Components/Avatar.vue';
import BreadCrumb from '@/Components/BreadCrumb.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import { ref } from 'vue';

const props = defineProps({
    therapist: {
        type: Object,
        default: () => {}
    },
    patient: {
        type: Object,
        default: () => {}
    },
    traitments: {
        type: Object,
        default: () => {}
    }
})

const windowSelected = ref(0)
</script>

<template>
    <therapist-layout :therapist="therapist.data">
    
        <bread-crumb :items="[
            {label :'Mes patients', url: route('therapist.patient.index', therapist.data)},
            {label : patient.data.name },
        ]" />


        <div class="bg-white border shadow-sm mb-2 mx-auto max-w-md mt-4">        
            <div class=" p-4 flex h-full flex-col justify-between">
                <div>
                    <div class="w-full flex justify-center">
                        <Avatar size="24" :name="patient.data.name.split(' ').map((s) => s[0]?.toUpperCase?.()).join('')" class=" my-3" />
                    </div>
                    <div class="block text-xl font-medium text-center text-gray-900">{{ patient.data.name }}</div>
                    <div class="text-sm text-gray-500 text-center ">{{ patient.data.email }}</div>
                    <div class="text-sm text-gray-500 text-center ">{{ $globals.formatTel(patient.data.tel) }}</div>

                    <template v-if="patient.data.next_traitment">
                        <div class="border self-stretch border-primary mx-auto my-2 w-[50%]"></div>
                        <div class="flex justify-center item-center gap-4 w-full text-center">
                            <div>
                                <div class="text-gray-500 grow uppercase text-xs">Prochain rendez vous :</div>
                                <div class="text-sm font-semibold text-primary  uppercase">Le {{ $globals.formatDate(patient.data.next_traitment.programmed_start_at)}}</div>
                            </div>
                        </div>
                    </template>
                    <template v-else>
                        <div class="w-full flex justify-center">
                            <SecondaryButton @click="$inertia.visit(route('therapist.patient.show', {therapist: therapist.data, patient: patient}))">Réserver un soin</SecondaryButton>
                        </div>
                    </template>
                    
                </div>
            </div>
            <!-- <div class="w-full flex">
                <div class="grow text-center border py-2" :class="windowSelected === 0 ? 'bg-primary text-white cursor-default' : 'hover:bg-primary/10 cursor-pointer'" @click="windowSelected = 0">Notes</div>
                <div class="grow text-center border py-2" :class="windowSelected === 1 ? 'bg-primary text-white cursor-default' : 'hover:bg-primary/10 cursor-pointer'" @click="windowSelected = 1">Soins</div>
                <div class="grow text-center border py-2" :class="windowSelected === 2 ? 'bg-primary text-white cursor-default' : 'hover:bg-primary/10 cursor-pointer'" @click="windowSelected = 2">Factures</div>
            </div> -->
        </div>

        <div class="pt-4">
            <ul v-if="windowSelected === 0">
                <li>
                    Fiche patient
                </li>
                <li>
                    Notes du therapeute
                </li>
                <li>
                    Index des traitments recu et a venir
                </li>
            </ul>
            <div class="bg-white p-2 rounded">
                <TraitmentIndex :traitments="traitments?.data" />
            </div>
        </div>
    </therapist-layout>
</template>