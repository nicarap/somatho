<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    aze
    <div x-data="{ state: $wire.entangle('{{ $getStatePath() }}') }">
        <!-- Interact with the `state` property in Alpine.js -->

        <div id="mapid" style="width: 600px; height: 400px;" wire:ignore></div>

    </div>
</x-dynamic-component>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        console.log("aze")
        var mymap = L.map('mapid').setView([51.505, -0.09], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(mymap);
    })
</script>