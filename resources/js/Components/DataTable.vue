<script setup>

const props = defineProps({
    items:{
        type: Array,
        default: () => []
    },
    headers:{
        type: Array,
        default: () => []
    },
    headerKeyText:{
        type: String,
        default: 'text'
    },
    headerKeyId:{
        type: String,
        default: 'key'
    }
})
</script>

<template>

<div class="relative overflow-x-auto">

    <table class="w-full text-sm text-left text-gray-500 ">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr class="bg-gray-500 text-gray-200">
                <th v-for="col in headers" scope="col" class="px-3 py-4">
                    {{ col[headerKeyText] }}
                </th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in items" class="bg-white border-b">
                <td v-for="col in headers" class="px-3 py-2">
                    <template v-if="$slots[col[headerKeyId]]">
                        <slot :name="col[headerKeyId]" :item="item" />
                    </template>
                    <template v-else>
                        {{ item[col[headerKeyId]] }}
                    </template>
                </td>
            </tr>
        </tbody>
    </table>
</div>


</template>