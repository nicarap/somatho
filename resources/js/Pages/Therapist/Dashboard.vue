<script setup>
import TherapistLayout from '@/Layouts/TherapistLayout.vue';

defineProps({
    therapist: {
        type: Object,
    }
})

</script>

<template>
    <therapist-layout :therapist="therapist" title="Dashboard">
        <div class="bg-white">
            <!-- TODO  -->
            <ul>{{therapist.name}}
                <li>Stats nb patients</li>
                <li>patients de la journée / de deamain</li>
                <li>patients / jours</li>
            </ul>
        </div>
    </therapist-layout>
</template>
