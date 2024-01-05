<div class="grid gap-6 text-center md:grid-cols-3 lg:gap-12">
    @foreach($reviews as $review)
    <div class="@if($loop->even) -translate-y-6 @endif md:mb-0 border p-4 rounded-md shadow-md">
        <div class="mb-6 flex justify-center">
            <img src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20(1).jpg" class="w-32 rounded-full shadow-lg dark:shadow-black/30" />
        </div>
        <h5 class="mb-4 text-xl font-semibold">
            {{$review->name}}
        </h5>
        <p class="mb-4">
            <span class="fill-secondary-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-7 w-7 pr-2" viewBox="0 0 24 24">
                    <path d="M13 14.725c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275zm-13 0c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275z" />
                </svg>
            </span>
            {{$review->content}}
        </p>

        <div class="flex gap-1 justify-center fill-yellow-400">
            @for($i=1; $i<=$review->value; $i++) <x-icones.fullStar></x-icones.fullStar> @endfor

                @if (strpos($review->value,'.'))
                <x-icones.halfStar></x-icones.halfStar>
                @php $i++; @endphp
                @endif

                @for($j=$i; $j<=5; $j++) <x-icones.emptyStar></x-icones.emptyStar> @endfor

        </div>
    </div>
    @endforeach

</div>