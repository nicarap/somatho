<div class="flex flex-wrap items-center gap-1">
    @if ($tags)
        @foreach ($tags as $tag)
            <div class="flex max-w-max">
                <div style="background-color: {{ $tag->color }}25"
                     class="fi-badge flex items-center justify-center gap-x-1 whitespace-nowrap rounded-md  text-xs font-medium px-2 py-1">
                    <span style="color: {{ $tag->color }}">
                        {{ mb_strtoupper($tag->name) }}
                    </span>
                </div>
            </div>
        @endforeach
    @endif
</div>
