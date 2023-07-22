<template>
    <div class="bg-gray-100 h-screen">
        <div class="p-4"><button @click="$inertia.visit(route('dashboard'))">BACK</button></div>
        <div class="flex w-full items-center justify-center gap-4">
            <div>
                <div class="grid grid-cols-3 gap-2">
                    <div
                        v-for="(therapist, index) in therapists.data"
                        :key="index"
                        class="bg-white border shadow-sm p-4 mb-2 hover:bg-gray-200 hover:cursor-pointer"
                        @click="therapistselected = therapist"
                    >
                        {{ therapist.name }}
                    </div>
                </div>
            </div>
            <div class="min-w-1/4 whitespace-pre-line">
                <div>therapist :</div>
                <pre>{{therapistselected ||'Cliquer sur un therapist'}}</pre>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "index",
    props: {
        therapists: {
            type: Object,
            default: () => [],
        },
    },
    data() {
        return {
            therapistselected: null,
        };
    },
};
</script>