<script setup>
import TherapistLayout from "@/Layouts/TherapistLayout.vue";
import Agenda from "@/Components/Agenda.vue";
import moment from "moment/moment";
import Modal from "@/Components/Modal.vue";
import CreateTraitment from "@/Pages/Traitment/Create.vue";
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
});

const openModal = ref(false);
const filters = ref({});
const traitmentsLoaded = ref(false);
const traitmentsLoading = ref(false);
const selectedTraitment = ref(null);
const numWeek = ref(parseInt(moment().format('W')))
const computedTraitments = computed(() => props.traitments)
const storeTraitments = ref([])
const setDateTime = (date, time) => {
    return moment(date + " " + time, "YYYY-MM-DD HH:mm");
};


const click = (start_at, hour, user) => {
    let date = setDateTime(start_at.format("YYYY-MM-DD"), hour);
    openReserveModal({
        therapist: props.therapist,
        programmed_start_at: date.format("YYYY-MM-DD HH:mm"),
        programmed_end_at: date.add(1.5, "h").format("YYYY-MM-DD HH:mm"),
    });
};

const clickHalf = (start_at, hour, user) => {
    let date = setDateTime(start_at.format("YYYY-MM-DD"), hour);
    openReserveModal({
        therapist: props.therapist,
        programmed_start_at: date.add(30, "m").format("YYYY-MM-DD HH:mm"),
        programmed_end_at: date.add(1.5, "h").format("YYYY-MM-DD HH:mm"),
    });
};

const openReserveModal = (traitment) => {
    if (
        // isReserved(traitment.programmed_start_at) || // TODO : ne marche pas
        isPassed(traitment.programmed_end_at)
    )
        return false;

    openModal.value = true;
    selectedTraitment.value = traitment

    filters.value = {
        therapist_id: props.therapist.id,
        patient_id: traitment.patient?.id,
        programmed_start_at: traitment.programmed_start_at,
        programmed_end_at: traitment.programmed_end_at,
    };
};

const isPassed = (date) => date < moment();

const isReserved = (date) => {
    if (
        props.traitments.find((s) =>
            moment(date).isBetween(moment(s.start_at), moment(s.end_at), "days")
        )
    )
        return true;
};

const closeReserveModal = () => {
    openModal.value = false;
    selectedTraitment.value = null
};

const getPosition = (start, end) => {
    let top = "top-0";
    let minutes = moment(start).minutes();

    switch (minutes) {
        case 0:
            top = "top-0";
            break;
        case 15:
            top = "top-1/3";
            break;
        case 30:
            top = "top-1/2";
            break;
        case 45:
            top = "top-2/3";
            break;
    }

    return `${top}`;
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
    return getDate(s.programmed_start_at, "yyyyMMDDHH");
};

const createReservation = (form) => {
    form.post(route("therapist.traitment.store", {therapist: props.therapist}), {
        onFinish: () => (openModal.value = false),
    });
};

const updateReservation = (form) => {
    form.put(route("therapist.traitment.update", {therapist: props.therapist, traitment:selectedTraitment.value}), {
        onFinish: () => (openModal.value = false),
    });
};

const getSoins = (week) => {
    router.get(
        route("therapist.agenda", { therapist: props.therapist }),
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

onMounted(() => {
    getSoins(numWeek);
});

watch(traitmentsLoaded, (val) => {
    getSoins();
});

watch(numWeek, (val) => {
    if(storeTraitments.value.filter((s) => moment(s.programmed_start_at).week() === val).length === 0){
        getSoins(val);
    }
})

watch(computedTraitments, (val) => storeTraitments.value = [...storeTraitments.value, ...val])
</script>

<template>
    <therapist-layout
        title="Profile"
        :therapist="therapist"
    >
        <Agenda v-model:numWeek="numWeek"
            :therapist="therapist"
            @previousWeek="numWeek--"
            @nextWeek="numWeek++"
            @click="click"
            @clickHalf="clickHalf"
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
                    :class="getPosition(s.programmed_start_at, s.programmed_end_at)"
                    :style="{height: getHeight(s.programmed_start_at, s.programmed_end_at)}"
                    @click="openReserveModal(s)"
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
        <pre>{{ storeTraitments.length }}</pre>
    </therapist-layout>

    <Modal
        :show="openModal"
        @close="closeReserveModal"
        maxWidth="sm"
    >
        <create-traitment
            @updateReservation="updateReservation"
            @createReservation="createReservation"
            :therapist="therapist"
            :filters="filters"
            @cancel="closeReserveModal"
        />
    </Modal>

</template>