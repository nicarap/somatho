<x-filament-panels::page>
    {{ $this->profileInfolist }}

    <div class="flex justify-end">
        <x-filament::button color="primary" wire:click="createAddress">
            Ajouter une adresse
        </x-filament::button>
    </div>

    <x-filament::grid class="gap-4">
        @foreach ($therapist->addresses as $address)
            <div @class([
                'fi-in-repeatable-item block',
                'rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-950/5 dark:bg-white/5 dark:ring-white/10',
            ])>
                <div>
                    <div class="flex w-full justify-between">
                        <div>
                            <span class="block text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                Nom de l'adresse
                            </span>
                            {{ $address->name }}
                        </div>

                        @if ($address->pivot->default)
                            <div class="w-6 h-6">
                                <x-heroicon-o-check-circle></x-heroicon-o-check-circle>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="mt-4 grid grid-cols-2 --col-lg" wire:click="markAsDefault('{{ $address->id }}')"
                     wire:key="{{ $address->id . $address->pivot->default }}">

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
            </div>
        @endforeach
    </x-filament::grid>

    {{ $this->therapist->name }}
</x-filament-panels::page>
