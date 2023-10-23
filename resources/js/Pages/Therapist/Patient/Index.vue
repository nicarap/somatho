<template>
    <therapist-layout
        title="Profile"
        :therapist="therapist.data"
    >

        <bread-crumb :items="[{label :'Mes patients'}]">
            <PrimaryButton @click="$inertia.visit(route('therapist.patient.create', {therapist: therapist.data}))">
                <div class="flex gap-2 items-center">
                    <font-awesome-icon icon="plus" />
                    <span> Ajouter un patient</span>
                </div>
            </PrimaryButton>
        </bread-crumb>
        
        <div class="mt-4">
            <input type="text" placeholder="Recherche par nom" v-model="patient_name" />
            <div class="flex gap-4 mt-4 items-start">
                <div v-for="(patient, index) in patients" :key="index" 
                class="bg-white border shadow-sm p-4 mb-2 w-full max-w-xs">        
                <div class="flex h-full flex-col justify-between">
                    <div><div class="w-full flex justify-center">
                        <Avatar size="24" :name="patient.name.split(' ').map((s) => s[0]?.toUpperCase?.()).join('')" class=" my-3" />
                    </div>
                    <div class="block text-xl font-medium text-center text-gray-900">{{ patient.name }}</div>
                    <div class="text-sm text-gray-500 text-center ">{{ patient.email }}</div>
                        <template v-if="patient.next_traitment">
                            <div class="border self-stretch border-primary mx-auto my-2 w-[50%]"></div>
                            <div class="flex justify-center item-center gap-4 w-full text-center">
                                <div>
                                    <div class="text-gray-500 grow uppercase text-xs">Prochain rendez vous :</div>
                                    <div class="text-sm font-semibold text-primary  uppercase">Le {{ $globals.formatDate(patient.next_traitment.programmed_start_at)}}</div>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="pt-4 w-full flex justify-center">
                        <SecondaryButton @click="$inertia.visit(route('therapist.patient.show', {therapist: therapist.data, patient: patient}))">Voir la fiche</SecondaryButton>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </therapist-layout>
</template>

<script>
import SecondaryButton from '@/Components/SecondaryButton.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Avatar from '@/Components/Avatar.vue';
import BreadCrumb from '@/Components/BreadCrumb.vue';
import TherapistLayout from '@/Layouts/TherapistLayout.vue';
export default {
    name: 'index',
    components: {
        TherapistLayout, Avatar, SecondaryButton, PrimaryButton, BreadCrumb
    },
    props:{
        therapist:{
            type: Object,
            default: () => null,
        },
        next_traitment: {
            type: Object,
            default: () => null
        }
    },
    data(){
        return{
            patients: [],
            patient_name: null,
        }
    },
    mounted(){
        this.initialize();
    },
    methods: {
        initialize(){
            this.patients = this.therapist.data.patients
        }
    },
    watch: {
        patient_name(val){
            if(val){
                this.patients = this.patients.filter((p) => p.name.includes(val))
            }else this.initialize()
        }
    }
}
</script>