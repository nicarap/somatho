<x-filament-panels::page>
    {{ $this->profileInfolist }}

    <x-filament::grid class="gap-4">
        @foreach ($therapist->addresses as $address)
            <div @class([
                'fi-in-repeatable-item block',
                'rounded-xl bg-white p-4 shadow-sm ring-1 ring-gray-950/5 dark:bg-white/5 dark:ring-white/10',
            ])>
                <div class="grid grid-cols-2 --col-lg">
                    <div>
                        <span class="block text-sm font-medium leading-6 text-gray-950 dark:text-white">
                            Nom de l'adresse
                        </span>
                        {{ $address->name }}
                    </div>
                    <div>
                        <span class="block text-sm font-medium leading-6 text-gray-950 dark:text-white">
                            Rue
                        </span>
                        {{ $address->street }}
                    </div>
                    <div>
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
