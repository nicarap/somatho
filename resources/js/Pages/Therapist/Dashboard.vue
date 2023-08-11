<script setup>
import Widget from '@/Components/Widget.vue';
import TherapistLayout from '@/Layouts/TherapistLayout.vue';

defineProps({
    therapist: {
        type: Object,
    },
    traitments_count_by_week: {
        type: Number,
        default: 0
    },
    traitments_count_by_day: {
        type: Number,
        default: 0
    },
    next_traitment: {
        type: Object,
        default: null,
    }
})

</script>

<template>
    <therapist-layout :therapist="therapist" title="Dashboard">
        
        <div class="grid grid-cols-3 gap-16">
                <Widget class="-w-md w-full shadow">
                    <div class="w-full flex justify-between items-center text-primary cursor-pointer">
                        <h1 class="text-xl uppercase tracking-widest">Cette semaine</h1>
                        <div class="w-6 h-6 rounded-full flex items-center justify-center hover:bg-gray-200"><font-awesome-icon icon="square-arrow-up-right" /></div>
                    </div>
                    <div class="flex gap-2">
                        <div class="flex gap-2 items-end">
                            <span class="text-7xl flex justify-center font-semibold text-primary">{{ traitments_count_by_week }}</span>
                            <div class="text-gray-500  uppercase text-xs">Patients</div>
                        </div>
                    </div>
                </Widget>
                <Widget class="-w-md w-full shadow">
                    <div class="w-full flex justify-between items-center text-primary cursor-pointer">
                        <h1 class="text-xl uppercase tracking-widest">Aujourd'hui</h1>
                        <div class="w-6 h-6 rounded-full flex items-center justify-center hover:bg-gray-200">
                            <font-awesome-icon icon="square-arrow-up-right" />
                        </div>
                    </div>
                    <div class="flex gap-2 items-end">
                        <div class="flex gap-2 items-end">
                            <span class="text-7xl flex justify-center font-semibold text-primary">{{ traitments_count_by_day }}</span>
                            <div class="text-gray-500  uppercase text-xs">Patients</div>
                        </div>
                        <div class="border self-stretch border-primary"></div>
                        <div v-if="next_traitment">
                            <div class="text-gray-500 grow uppercase text-xs">Prochain patient :</div>
                            <div class="text-xl font-semibold text-primary  uppercase">{{ next_traitment.patient.name }}</div>
                            <div class="text-sm font-semibold text-primary  uppercase">Le {{ moment(next_traitment.programmed_start_at).format('DD/MM/YYYY à HH:mm') }}</div>
                        </div>
                    </div>
                </Widget>
                <Widget class="-w-md w-full shadow">
                    <div class="w-full flex justify-between items-center text-primary cursor-pointer">
                        <h1 class="text-xl uppercase tracking-widest">Messages</h1>
                        <div class="w-6 h-6 rounded-full flex items-center justify-center hover:bg-gray-200"><font-awesome-icon icon="square-arrow-up-right" /></div>
                    </div>
                    <div class="flex gap-2 items-end">
                        <span class="text-7xl flex justify-center font-semibold text-primary">{{ traitments_count_by_day }}</span>
                        <div class="text-gray-500 uppercase text-xs">nouveaux messages</div>
                    </div>
                </Widget>
            </div>
    </therapist-layout>
</template>
