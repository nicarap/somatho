<x-filament-panels::page>
    {{ $this->profileInfolist }}

    <x-filament::section>
        <x-slot name="heading">
            Informations
        </x-slot>
        {{ $this->form }}
        <div class="flex justify-end mt-2">
            <x-filament::button wire:click="submit" color="success">
                Sauvegarder
            </x-filament::button>
        </div>
    </x-filament::section>

    <x-filament::section>
        <x-slot name="heading">
            Adresse
        </x-slot>
        @php($address = $therapist->address)

        <div>
            <div>
                <span class="block text-sm font-medium leading-6 text-gray-950 dark:text-white">
                    Nom de l'adresse
                </span>
                {{ $address->name }}
            </div>
            <div class="mt-4 grid grid-cols-2 --col-lg" wire:click="markAsDefault('{{ $address->id }}')"
                 wire:key="{{ $address->id }}">

                <div class="mt-2">
                    <span class="block text-sm font-medium leading-6 text-gray-950 dark:text-white">
                        Rue
                    </span>
                    {{ $address->street }}
                </div>
                <div class="mt-2">
                    <span class="block text-sm font-medium leading-6 text-gray-950 dark:text-white">
                        Context
                    </span>
                    {{ $address->context }}
                </div>
                <div class="mt-2">
                    <span class="block text-sm font-medium leading-6 text-gray-950 dark:text-white">
                        Ville
                    </span>
                    {{ $address->city }}
                </div>
                <div class="mt-2">
                    <span class="block text-sm font-medium leading-6 text-gray-950 dark:text-white">
                        Code postal
                    </span>
                    {{ $address->postcode }}
                </div>
            </div>



            <div class="flex justify-end">
                <x-filament::button color="warning" wire:click="editAddress">
                    Modifier l'adresse
                </x-filament::button>
            </div>
        </div>
    </x-filament::section>
</x-filament-panels::page>
