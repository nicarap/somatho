<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">dsq
    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }">
        <!-- Interact with the `state` property in Alpine.js -->
        Address dqs
    </div>
</x-dynamic-component>