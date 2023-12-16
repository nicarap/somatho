<div>
    <div class="grid  sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-2 mt-4 items-start">
        @foreach($patients as $patient)

        <div wire:key="{{$patient->id}}" class="bg-white border shadow-sm p-4 mb-2 w-full sm:max-w-xs">
            <div class="flex h-full flex-col justify-between">
                <div>
                    <div class="w-full flex justify-center">
                    </div>
                    <div class="block text-xl font-medium text-center text-gray-900">{{ $patient->name }}</div>
                    <div class="text-sm text-gray-500 text-center ">{{ $patient->email }}</div>
                    <!-- <template v-if="patient.next_traitment">
                        <div class="border self-stretch border-primary mx-auto my-2 w-[50%]"></div>
                        <div class="flex justify-center item-center gap-4 w-full text-center">
                            <div>
                                <div class="text-gray-500 grow uppercase text-xs">Prochain rendez vous :</div>
                            </div>
                        </div>
                    </template> -->
                </div>
                <div class="pt-4 w-full flex justify-center">
                    <x-filament::button type="button" wire:click="showPatient({{ $patient }})" outlined>
                        Voir la fiche
                    </x-filament::button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>