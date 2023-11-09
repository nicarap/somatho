<script setup>
import { router } from '@inertiajs/vue3';
import { ref } from 'vue';
import Modal from '@/Components/Modal.vue';
import CreateAddress from "@/Components/Address/Create.vue"
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

const props = defineProps({
    user:{
        type: Object,
        default: () => {}
    },
});

const setDefaultAddress = (address) => {
    if(!address.pivot.default){
        router.put(route('therapist.address.changeDefaultAddress', {therapist: props.user, address: address}), 
        {
            'is_default': true,
        }, {
            preserveState: true,
        })
    }
}

const openAddNewAddressModal = ref(false);
const openDeleteAddressModal = ref(false);
const deleteAddressSelected = ref(null);

const deleteAddressModal = (address) => {
    openDeleteAddressModal.value = true
    deleteAddressSelected.value = address
}
const closeAddNewAddressModal = () => openAddNewAddressModal.value = false
const closeDeleteAddressModal = () => openDeleteAddressModal.value = false


const createNewAddress = (form) => {
    form.user = props.therapist
    form.post(route('address.store'), {
        onFinish: () => openAddNewAddressModal.value = false,
    })
}

const deleteAddress = (address) => {
    router.delete(route('address.destroy', {address: address}), {
        onFinish: () => {
            deleteAddressSelected.value = null
            closeDeleteAddressModal()
        }
    })
}
</script>

<template>
    <div>
        <div class="flex justify-between items-center h-full text-gray-900">
            <section>
                <header>
                    <h2 class="text-lg font-semibold uppercase text-primary">Mes adresses</h2>
                    <span class="text-sm text-gray-600">
                        Mettre à jour mon adrese.
                    </span>
                </header>
            </section>
        </div>
        <div class="grid grid-cols-3 gap-2">
            <div v-for="(address, index) in user.addresses" :key="index" 
                class="rounded-lg mt-2 border-2  text-gray-700 p-2 bg-white"
                :class="[address.pivot.default ? 'border-primary' : 'hover:border-primary']">
                <div class="uppercase flex w-full justify-between items-center text-sm font-semibold">
                    {{ address.name }}
                            <div class="min-w-6 ">
                    <span v-if="address.pivot.default" class="fa-stack fa-xs">
                        <font-awesome-icon icon="certificate" class="fa-stack-2x text-primary" />
                        <font-awesome-icon icon="check"  class="fa-stack-1x fa-inverse" />
                    </span>
                    <template v-else>
                        <div class="flex items-center gap-2">
                            <span @click="setDefaultAddress(address)" class="fa-stack fa-xs hover:cursor-pointer">
                                <font-awesome-icon icon="certificate" class="fa-stack-2x text-gray-200" />
                                <font-awesome-icon icon="check"  class="fa-stack-1x fa-inverse" />
                            </span>
                            <font-awesome-icon @click="deleteAddressModal(address)" icon="trash-alt" class="text-red-600 text-opacity-50 cursor-pointer hover:text-opacity-100"
                            title="Supprimer cette adresse" />
                        </div>
                    </template>
                </div>
                </div>
                <div>{{ address.label }}</div>
                <div>{{ address.context }}</div>
                <div>{{ address.postcode }}, {{ address.city }}</div>
            </div>
            <div @click="openAddNewAddressModal = true" title="Ajouter une adresse"
                class="rounded-lg mt-2 border-2 border-dashed text-gray-700 p-2 cursor-pointer hover:border-primary group">
                <div class="uppercase flex h-full w-full justify-center items-center text-sm font-semibold">
                    <font-awesome-icon icon="plus" class="text-gray-400 group-hover:text-primary" size="2xl" />
                </div>
            </div>
        </div>
        
        <Modal
            :show="openAddNewAddressModal"
            @close="closeAddNewAddressModal">
            <div class="p-4 bg-primary text-white uppercase shadow">
                <h1>Ajouter une nouvelle adresse</h1>
            </div>
            <div class="p-2 ">
                
                <CreateAddress 
                    @save="createNewAddress"
                    @cancel="closeAddNewAddressModal" :user="user">
                </CreateAddress>
            </div>
        </Modal>
        
        <Modal :show="openDeleteAddressModal">
            <div class="p-4 bg-red-500 text-white uppercase shadow">
                <h1>Confirmation</h1>
            </div>
            <div class="p-2 ">
                <p class="py-6 text-center">Êtes-vous sur de vouloir supprimer cette adresse ?</p>
                
                <div class="flex justify-center">
                    <div>
                        <div class="uppercase flex w-full justify-between items-center text-sm font-semibold">
                            {{ deleteAddressSelected.name }}
                        </div>
                        <div>{{ deleteAddressSelected.label }}</div>
                        <div>{{ deleteAddressSelected.context }}</div>
                        <div>{{ deleteAddressSelected.postcode }}, {{ deleteAddressSelected.city }}</div>
                    </div>
                
            </div>
                <div class="flex w-full mt-2 justify-end items-center gap-2">
                    <SecondaryButton @click="closeDeleteAddressModal">Annuler</SecondaryButton>
                    <DangerButton @click="deleteAddress(deleteAddressSelected)">Supprimer</DangerButton>
                </div>
            </div>
        </Modal>
    </div>
</template>
