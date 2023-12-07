<x-filament-panels::page>
    @php($patients = $this->getPatients())
    <livewire:patient.list-patients :patients="$patients"></livewire:patient.list-patients>
</x-filament-panels::page>