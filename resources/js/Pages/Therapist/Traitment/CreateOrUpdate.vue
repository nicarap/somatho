<script setup>
import Create from '@/Components/Traitment/Create.vue';
import Update from '@/Components/Traitment/Update.vue';
import Complete from '@/Components/Traitment/Complete.vue';
import axios from 'axios';
import { ref, onMounted } from 'vue';

defineEmits(["updateReservation","createReservation", "cancelReservation", "cancel"])

const props = defineProps({
    therapist: {type: Object, default: () => {}},
    patients: {type: Object, default: () => {}},
    traitment: {type: Object, default: () => {}},
    filters: {
        type: Object,
        default: () => {}
    },
})

</script>

<template>
    <template v-if="props.traitment">
        <!-- <template v-if="props.traitment.is_passed">
            <div class="p-4 bg-primary text-white uppercase shadow flex w-full items-center justify-between">
                <h1>Réservation passée</h1>
                
                <font-awesome-icon
                icon="check" class="text-white cursor-pointer hover:text-green-500"
                        title="Annuler la réservation" />
            </div>
            

            <complete
                @cancel="() => $emit('cancel')"
                @updateReservation="(f) => $emit('updateReservation', f)"
                @cancelReservation="(f) => $emit('cancelReservation', f)"
                v-bind="{therapist, patients, traitment}">
            </complete>

        </template>
        <template v-else>
            <div class="p-4 bg-primary text-white uppercase shadow flex w-full items-center justify-between">
                <h1>Modification de la réservation</h1>
                
                <font-awesome-icon @click="$emit('cancelReservation', traitment)" icon="trash-alt" class="text-white cursor-pointer hover:text-red-700"
                        title="Annuler la réservation" />
            </div>

            <update
                @cancel="() => $emit('cancel')"
                @updateReservation="(f) => $emit('updateReservation', f)"
                @cancelReservation="(f) => $emit('cancelReservation', f)"
                v-bind="{therapist, patients, traitment}">
            </update>
        </template> -->
        
        <update
                @cancel="() => $emit('cancel')"
                @updateReservation="(f) => $emit('updateReservation', f)"
                @cancelReservation="(f) => $emit('cancelReservation', f)"
                v-bind="{therapist, patients, traitment}">
            </update>
    </template>
    <template v-else>
        <div class="p-4 bg-primary text-white uppercase shadow">
            <h1>Créer une réservcation</h1>
        </div>

        <create
            @cancel="() => $emit('cancel')"
            @createReservation="(f) => $emit('createReservation', f)"
            v-bind="{filters, patients, therapist}">
        </create>
    </template>
</template>