<script setup>
import TherapistLayout from "@/Layouts/TherapistLayout.vue";
import Agenda from "@/Components/Agenda.vue";
import moment from "moment/moment";
import Modal from "@/Components/Modal.vue";
import CreateOrUpdateTraitment from "@/Pages/Therapist/Traitment/CreateOrUpdate.vue";
import { onMounted, ref, watch, computed } from "vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
    therapist: {
        type: Object,
    },
    traitments: {
        type: Array,
        default: () => [],
    },
    patients: {type: Object, default: () => {}},
});

const openModal = ref(false);
const filters = ref({});
const traitmentsLoaded = ref(false);
const traitmentsLoading = ref(false);
const selectedTraitment = ref(null);
const numWeek = ref(parseInt(moment().format('W')))
const storeTraitments = ref(props.traitments)

const setDateTime = (date, time) => {
    return moment(date + " " + time, "YYYY-MM-DD HH:mm");
};

const click = (date) => {    
    openReserveModal({
        therapist: props.therapist.data,
        programmed_start_at: date.format("YYYY-MM-DD HH:mm"),
        programmed_end_at: date.add(1.5, "h").format("YYYY-MM-DD HH:mm"),
    });
};

// const clickHalf = (start_at, hour, user) => {
//     let date = setDateTime(start_at.format("YYYY-MM-DD"), hour);
//     openReserveModal({
//         therapist: props.therapist.data,
//         programmed_start_at: date.add(30, "m").format("YYYY-MM-DD HH:mm"),
//         programmed_end_at: date.add(1.5, "h").format("YYYY-MM-DD HH:mm"),
//     });
// };

const openReserveModal = (traitment) => {
    if (
        isPassed(traitment.programmed_end_at)
    )
        return false;
        
    openModal.value = true;

    filters.value = {
        id: traitment.id,
        therapist_id: props.therapist.data.id,
        patient_id: traitment.patient?.id,
        address_id: traitment.address_id,
        programmed_start_at: traitment.programmed_start_at,
        programmed_end_at: traitment.programmed_end_at,
    };
};
const openReservedModal = (traitment) => {
    selectedTraitment.value = traitment;
    selectedTraitment.value.is_passed = isPassed(moment(traitment.programmed_end_at))
    openModal.value = true;
};

const isPassed = (date) => {
    date < moment()
};

const closeReserveModal = () => {
    openModal.value = false;
    selectedTraitment.value = null
};

const getHeight = (start, end) => {
    let { hours, minutes } = getDuration(start, end);
    return hours * 3 + (minutes / 60) * 3 + "rem";
};

const getDuration = (start, end) => {
    let date_start = moment(start);
    let date_end = moment(end);
    let duration = moment.duration(date_end.diff(date_start));

    return { hours: duration.hours(), minutes: duration.minutes() };
};

const getDate = (timestamp, format = "yyyyMMDD") => {
    let date = moment(timestamp);
    return moment(date).format(format);
};

const getSlotsName = (s) => {
    return getDate(s.programmed_start_at, "yyyyMMDDHHmm");
};

const createReservation = (form) => {
    form.post(route("therapist.traitment.store", {therapist: props.therapist.data}), {
        only: ['traitments'],
        onFinish: () => openModal.value = false,
    });
};

const updateReservation = (form) => {
    form.put(route("therapist.traitment.update", {therapist: props.therapist.data, traitment:selectedTraitment.value}), {
        onFinish: () => openModal.value = false,
    });
};

const cancelReservation = () => {
    router.delete(route('therapist.traitment.destroy', {therapist: props.therapist.data, traitment: selectedTraitment.value.id}), {
        onFinish: () => {
            openModal.value = false;
            storeTraitments.value = storeTraitments.value.filter((t) => t.id !== selectedTraitment.value.id);
        },
    });
}

const getSoins = (week) => {
    router.get(
        route("therapist.agenda", { therapist: props.therapist.data }),
        {
            filter: {
                start_at: moment().startOf('week').week(week).format('YYYY-MM-DD'),
                end_at: moment().endOf('week').week(week).format('YYYY-MM-DD'),
            },
        },
        {
            onBefore: () => (traitmentsLoading.value = true),
            only: ["traitments"],
            preserveState: true,
            onFinish: () => (traitmentsLoading.value = false),
        }
    );
};

const getPatients = () => {
    router.get(
        route("therapist.agenda", { therapist: props.therapist.data }),
        {},
        {
            only: ["patients"],
            preserveState: true,
        }
    );
}

onMounted(() => {
    getPatients();
});

watch(traitmentsLoaded, (val) => {
    getSoins();
});

watch(numWeek, (val) => {
    if(storeTraitments.value.filter((s) => moment(s.programmed_start_at).week() === val).length === 0){
        getSoins(val);
    }
})

watch(props.traitments, (val) => storeTraitments.value = [...storeTraitments.value, ...val])

</script>

<template>
    <therapist-layout
        title="Profile"
        :therapist="therapist.data"
    >
    
        <Agenda v-model:numWeek="numWeek"
            :therapist="therapist.data"
            @today="numWeek = parseInt(moment().format('W'))"
            @previousWeek="numWeek--"
            @nextWeek="numWeek++"
            @click="click"
            :loading="traitmentsLoading"
        >
        
            <template
                v-for="(s, index) in storeTraitments"
                :key="index"
                v-slot:[getSlotsName(s)]
            >
                <div
                    class="absolute flex bg-gray-100 hover:bg-primary z-50 cursor-pointer overflow-hidden rounded-md
                    border-4 border-transparent border-l-primary left-0 right-0 group"
                    :style="{height: getHeight(s.programmed_start_at, s.programmed_end_at)}"
                    @click="openReservedModal(s)"
                >
                    <!-- <div class="bg-primary px-1 " /> -->
                    <div class="px-2 group-hover:text-white">
                        <div class="text-sm tracking-widest">{{ s.patient.name }}</div>
                        <div class="text-xs text-gray-500 group-hover:text-white">
                            {{ getDate(s.programmed_start_at, 'HH:m') }} - {{ getDate(s.programmed_end_at, 'HH:m') }}
                        </div>
                    </div>
                </div>
            </template>
        </Agenda>
        
    </therapist-layout>

    <Modal
        :show="openModal"
        @close="closeReserveModal"
        maxWidth="sm"
    >
        <create-or-update-traitment
            @updateReservation="updateReservation"
            @createReservation="createReservation"
            @cancelReservation="cancelReservation"
            @cancel="closeReserveModal"
            
            :therapist="therapist.data"
            :patients="patients"
            :traitment="selectedTraitment"
            :filters="filters"
        />
    
    </Modal>

</template>