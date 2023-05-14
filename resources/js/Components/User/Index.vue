<script setup>
import DataTable from '@/Components/DataTable.vue';

defineProps({
    users: Array,
});

const headers = [
            {key:'name', text:'Nom'}, 
            {key:'email', text:'Email'}, 
            {key:'tel', text:'Téléphone'}, 
            {key:'action', text:'Action'}
        ]

</script>

<template>
    <DataTable :items="users" :headers="headers" >
        <template #action="{ item }">
            <div class="grid grid-cols-3 items-center">
                <div v-if="item.policies.view" @click="$inertia.visit(route('user.show', item) )" 
                class="flex justify-center items-center h-8 w-8 rounded-full hover:bg-gray-200">
                    <font-awesome-icon icon="eye" />
                </div>
                <div v-if="item.policies.update" @click="$inertia.visit(route('user.edit', item) )" 
                class="flex justify-center items-center h-8 w-8 rounded-full hover:bg-gray-200">
                    <font-awesome-icon icon="edit" />
                </div>
                <div v-if="item.policies.delete" @click="$inertia.visit(route('user.destroy', item) )" 
                class="flex justify-center items-center h-8 w-8 rounded-full hover:bg-gray-200">
                    <font-awesome-icon icon="trash" />
                </div>
            </div>
        </template>
    </DataTable>
</template>