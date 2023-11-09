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
            <div class="max-w-md">
                <InputLabel for="name" value="Nom" />

                <TextInput
                    type="text"
                    class="mt-2 block w-full"
                    v-model="patient_name"
                    placeholder="Recherche par nom"
                />
            </div>
            <div class="grid  sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-2 mt-4 items-start">
                <template v-for="(patient, index) in therapist.data.patients" :key="index" >
                    <Transition 
                        enter-active-class="transition ease-out duration-200"
                        enter-from-class="transform opacity-0 scale-95"
                        enter-to-class="transform opacity-100 scale-100"
                        leave-active-class="transition ease-in duration-75"
                        leave-from-class="transform opacity-100 scale-100"
                        leave-to-class="transform opacity-0 scale-95"
                    >
                    <div v-show="patients.filter((p) => p.id === patient.id).length > 0"
                        class="bg-white border shadow-sm p-4 mb-2 w-full sm:max-w-xs">        
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
                    </Transition>
                </template>
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
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
export default {
    name: 'index',
    components: {
        TherapistLayout, Avatar, SecondaryButton, PrimaryButton, BreadCrumb,
        InputError,
        InputLabel,
        TextInput
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
            patient_name: "",
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
            this.patients = this.therapist.data.patients.filter((p) => p.name.toUpperCase().includes(val?.toUpperCase()))
        }
    }
}
</script>