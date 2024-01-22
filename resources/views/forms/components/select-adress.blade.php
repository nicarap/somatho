<x-filament::input.wrapper>
    <x-filament::input.select id="select-address">
        @foreach ($getOptions() as $value => $label)
        <option value="$value">{{$label}}</option>
        @endforeach
        <option value="draft">Draft</option>
        <option value="reviewing">Reviewing</option>
        <option value="published">Published</option>
    </x-filament::input.select>
</x-filament::input.wrapper>

@script
<script>
    let select = document.querySelector('#select-address');
    select.addEventListener("change", function (event) {
        console.log(this.options[this.selectedIndex]);
    });
</script>
@endscript