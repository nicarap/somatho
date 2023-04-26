<template>
    <div class="bg-gray-100 h-screen">
        <div class="p-4"><button @click="$inertia.visit(route('dashboard'))">BACK</button></div>
        <div class="flex w-full items-center justify-center gap-4">
            <div>
                <div class="grid grid-cols-3 gap-2">
                    <div v-for="patient in patients.data" class="bg-white border shadow-sm p-4 mb-2 hover:bg-gray-200 hover:cursor-pointer" @click="patientSelected = patient">
                    {{ patient.name }}
                    </div>
                </div>
            </div>
            <div class="min-w-1/4 whitespace-pre-line">
                <div>Patient :</div> 
                <pre>{{patientSelected ||'Cliquer sur un patient'}}</pre>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'index',
    props:{
        patients:{
            type: Object,
            default: () => [],
        }
    },
    data(){
        return{
            patientSelected: null,
        }
    }
}
</script>