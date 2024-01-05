<div class="flex gap-1 fill-yellow-400">
    @for($i=1; $i<=$getState(); $i++) <x-icones.fullStar></x-icones.fullStar>
        @endfor

        @if (strpos($getState(),'.'))
        <x-icones.halfStar></x-icones.halfStar>
        @endif

        @while($i <= 4) <x-icones.emptyStar></x-icones.emptyStar>
            @php
            $i++;
            @endphp
            @endwhile
</div>