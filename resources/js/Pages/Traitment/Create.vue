<script setup>
import Create from '@/Components/Traitment/Create.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const patients = ref([])

const getPatient = () => {
    axios(route('api.therapist.patients.index'))
    .then((response) => { patients.value = response.data })
}

onMounted(() => {
    getPatient();
})

</script>


<template>{{patient}}
    <create v-bind="$attrs" :patients="patients" />
</template>