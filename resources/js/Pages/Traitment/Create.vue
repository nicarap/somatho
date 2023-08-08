<script setup>
import Create from '@/Components/Traitment/Create.vue';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const getPatient = () => {
    axios(route('api.therapist.patients.index'))
    .then((response) => { console.log(response); patients.value = response.data })
}

const props = defineProps({
    user: {
        type: Object,
        default: () => {}
    }
})

onMounted(() => {
    if(!props.user) getPatient();
})

</script>


<template>{{patients}}
    <create v-bind="$attrs" :patients="user" />
</template>