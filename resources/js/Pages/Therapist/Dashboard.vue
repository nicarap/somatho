<script setup>
import Widget from '@/Components/Widget.vue';
import TherapistLayout from '@/Layouts/TherapistLayout.vue';

defineProps({
    therapist: {
        type: Object,
    },
    traitments_by: {
        type: Object,
        default: () => {}
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
                <Widget class="w-full flex flex-col justify-between shadow">
                    <div class="w-full flex justify-between items-center text-primary cursor-pointer">
                        <div>
                            <h1 class="text-xl uppercase tracking-widest">Cette semaine</h1>
                            <span class="text-xs text-gray-400">
                                {{ moment(traitments_by.week.date, 'isoWeek').format('DD/MM/YYYY') }}
                                 - 
                                 {{ moment(traitments_by.week.date, 'isoWeek').endOf('isoWeek').format('DD/MM/YYYY') }}
                            </span>
                        </div>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center hover:bg-primary/75 hover:text-white">
                            <font-awesome-icon icon="arrow-up-right-from-square" />
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <div class="flex gap-2 items-end">
                            <span class="text-7xl flex justify-center font-semibold text-primary">{{ traitments_by.week.count }}</span>
                            <div class="text-gray-500  uppercase text-xs">Patients</div>
                        </div>
                    </div>
                </Widget>

                <Widget class=" w-full flex flex-col justify-between shadow">
                    <div class="w-full flex justify-between items-center text-primary cursor-pointer">
                        <div>
                            <h1 class="text-xl uppercase tracking-widest">Aujourd'hui</h1>
                            <span class="text-xs text-gray-400">
                                {{ moment(traitments_by.day.date).format('DD/MM/YYYY') }}
                            </span>
                        </div>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center hover:bg-primary/75 hover:text-white">
                            <font-awesome-icon icon="arrow-up-right-from-square" />
                        </div>
                    </div>
                    <div class="flex gap-2 items-end">
                        <div class="flex gap-2 items-end">
                            <span class="text-7xl flex justify-center font-semibold text-primary">{{ traitments_by.day.count }}</span>
                            <div class="text-gray-500  uppercase text-xs">Patients</div>
                        </div>
                        <template v-if="next_traitment">
                            <div class="border self-stretch border-primary"></div>
                            <div>
                                <div class="text-gray-500 grow uppercase text-xs">Prochain patient :</div>
                                <div class="text-xl font-semibold text-primary  uppercase">{{ next_traitment.patient.name }}</div>
                                <div class="text-sm font-semibold text-primary  uppercase">Le {{ moment(next_traitment.programmed_start_at).format('DD/MM/YYYY à HH:mm') }}</div>
                            </div>
                        </template>
                    </div>
                </Widget>

                <Widget class="w-full flex flex-col justify-between shadow">
                    <div class="w-full flex justify-between items-center text-primary cursor-pointer">
                        <h1 class="text-xl uppercase tracking-widest">Messages</h1>
                        <div class="w-8 h-8 rounded-full flex items-center justify-center hover:bg-primary/75 hover:text-white">
                            <font-awesome-icon icon="arrow-up-right-from-square" />
                        </div>
                    </div>
                    <div class="flex gap-2 items-end">
                        <span class="text-7xl flex justify-center font-semibold text-primary">{{ traitments_by.day.count }}</span>
                        <div class="text-gray-500 uppercase text-xs">nouveaux messages</div>
                    </div>
                </Widget>
            </div>
    </therapist-layout>
</template>
