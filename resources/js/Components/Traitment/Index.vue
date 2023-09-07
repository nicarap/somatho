<script setup>

const props = defineProps({
    traitments: {
        type: Object,
        default: () => {} 
    }
})
</script>

<template>
    <table class="table-fixed w-full">
        <thead>
            <tr class="text-left">
                <th>date de début</th>
                <th>Date de fin</th>
                <th>Réalisé</th>
                <th>Prix</th>
                <th>Adresse</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(traitment, index) in traitments" :key="index">
                <td>{{ $globals.formatDate(traitment.programmed_start_at) }}</td>
                <td>{{ $globals.formatDate(traitment.programmed_end_at) }}</td>
                <td>{{ traitment.realized_at }}</td>
                <td>{{ traitment.price }}</td>
                <td>
                    <div>{{ traitment.label }}</div>
                    <div>{{ traitment.context }}</div>
                    <div>{{ traitment.city }}</div>
                </td>
            </tr>
        </tbody>
    </table>
</template>