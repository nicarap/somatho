<template>
    <therapist-layout
        title="Profile"
        :therapist="therapist.data"
    >

        <bread-crumb :items="[{label :'Mes patients', url: route('therapist.patient.index', {therapist: therapist.data})}, {label: 'Création'}]">
        </bread-crumb>
        
        <div class="p-4 mt-4 rounded w-full">
            <Create @submitForm="submit" @cancel="cancel" />
        </div>
        
    </therapist-layout>
</template>

<script>
import BreadCrumb from '@/Components/BreadCrumb.vue';
import Create from '@/Components/User/Create.vue';
import TherapistLayout from '@/Layouts/TherapistLayout.vue';

export default {
    name: 'index',
    components: {
    TherapistLayout, BreadCrumb,
    Create
},
    props:{
        therapist:{
            type: Object,
            default: () => null,
        },
    },
    methods: {
        submit(form) {
            console.log('submit', form)
        },
        cancel() {
            this.$inertia.visit(route('therapist.patient.index', {therapist: this.therapist.data}))
        }
    },
}
</script>