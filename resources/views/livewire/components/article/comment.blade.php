<div class="py-4">
    <form wire:submit="create">
        {{ $this->form }}

        <x-filament::button type="submit" color="success">
            New user
        </x-filament::button>

    </form>

    {{-- <x-filament-actions::modals /> --}}
</div>
