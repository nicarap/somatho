<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextAutocompleteField from '@/Components/TextAutocompleteField.vue';
import { useForm } from '@inertiajs/vue3';
import { ref, watch } from 'vue';
import Checkbox from '@/Components/Checkbox.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const emits = defineEmits(['cancel', 'save']);

const form = useForm({
    'address_name': '',
    'label': '',
    'name': '',
    'context': '',
    'postcode': '',
    'city': '',
    'longitude': 0,
    'latitude': 0,
    'default': false,
    'manual_address': false,
    'is_verified': true,
});

const _form = ref(null)
const itemsAddress = ref([]);
const errorAddress = ref(null)
const addressSelected = ref({})
const automaticAdressLoading = ref(false);

watch(addressSelected, (val) => {
    form.label = _.get(val, 'properties.label')
    form.name = _.get(val, 'properties.name')
    form.context = _.get(val, 'properties.context')
    form.postcode = _.get(val, 'properties.postcode')
    form.city = _.get(val, 'properties.city')
    form.longitude = _.get(val, 'geometry.coordinates.0')
    form.latitude = _.get(val, 'geometry.coordinates.1')
})
watch(() => form.manual_address, (val) => form.is_verified = !val)

const getAddress = (query) => {
    axios.get('https://api-adresse.data.gouv.fr/search', 
        {
            params: {q:query}
        }, {
            headers: {"Access-Control-Allow-Origin": "*"},
        }
    )
    .then((response) => {
        itemsAddress.value = response.data?.features; 
        errorAddress.value = null;
    })
    .catch((response) => {
        errorAddress.value = response.message
        itemsAddress.value = [];
    })
    .finally(() => automaticAdressLoading.value = false)
}
const debouncedSearchAddress = _.debounce(getAddress, 1500)
const searchAddress = (val) => {
    automaticAdressLoading.value = true;
    debouncedSearchAddress(val)
}

const submit = () => {
    if(_form.value.reportValidity()) emits('save', form)
}

</script>

<template>
    <form ref="_form" @submit.prevent="submit" class="space-y-2 p-2">
        <div>
            <InputLabel for="address_name" value="Nom" />
            <TextInput id="address_name" placeholder="ex: Chez moi, Au salon, ..." required class="mt-1 block w-full" type="text" v-model="form.address_name" />
            <InputError :message="form.errors.address_name" class="mt-2" />
        </div>
        
        <TextAutocompleteField label="Trouver mon adresse" 
            name="automaticAddress"
            v-model="addressSelected"
            :value="form.label"
            @search="searchAddress"
            placeholder="Commencez à écrire pour rechercher..."
            :items="itemsAddress" 
            :errors="errorAddress ? [errorAddress] : null"
            :required="!form.manual_address" 
            :loading="automaticAdressLoading"
            :disabled="form.manual_address" autocomplete="off" />
        
            <div class="flex gap-2 pt-4">
                <Checkbox v-model:checked="form.manual_address" id="manualAddress"/>
                <InputLabel for="manualAddress">Je renseigne mon adresse manuellement</InputLabel>
            </div>

            <div class="grid grid-cols-2 gap-2">
        
                <div>
                    <InputLabel for="name" value="Adresse" />
                    <TextInput id="name" class="mt-1 block w-full" :disabled="!form.manual_address" :required="form.manual_address" type="text" v-model="form.name" />
                    <InputError :message="form.errors.name" class="mt-2" />
                </div> 

                <div>
                    <InputLabel for="context" value="Complément d'adresse" />
                    <TextInput id="context" class="mt-1 block w-full" :disabled="!form.manual_address" :required="form.manual_address" type="text" v-model="form.context" />
                    <InputError :message="form.errors.context" class="mt-2" />
                </div> 

                <div>
                    <InputLabel for="postcode" value="Code postal" />
                    <TextInput id="postcode" class="mt-1 block w-full" :disabled="!form.manual_address" :required="form.manual_address" type="text" v-model="form.postcode" />
                    <InputError :message="form.errors.postcode" class="mt-2" />
                </div>

                <div>
                    <InputLabel for="city" value="Ville" />
                    <TextInput id="city" class="mt-1 block w-full" :disabled="!form.manual_address" :required="form.manual_address" type="text" v-model="form.city" />
                    <InputError :message="form.errors.city" class="mt-2" />
                </div>
        
                <div class="flex gap-2 pt-4">
                    <Checkbox v-model:checked="form.default" id="default"/>
                    <InputLabel for="default">Faire de cette adresse mon adresse principale</InputLabel>
                </div>
            </div>
        <div class="flex items-center justify-end gap-4">
            <SecondaryButton :disabled="form.processing" @click="$emit('cancel')">Annuler</SecondaryButton>
            <PrimaryButton :disabled="form.processing">Enregistrer</PrimaryButton>

            <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
            </Transition>
        </div>
    </form>
</template>