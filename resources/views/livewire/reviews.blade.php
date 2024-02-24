<div class="container mx-auto px-4">
    <div class="flex flex-wrap justify-center text-center mb-24">
        <div class="w-full lg:w-6/12 px-4">
            <h2 class="text-4xl font-semibold text-primary-500">Avis des patients</h2>
            <p class="text-lg font-light leading-relaxed text-justify md:text-center mt-4 mb-4 text-gray-700">
                Découvrez les témoignages inspirants à travers les retours authentiques des personnes qui m'ont fait
                confiance pour un soin en somatopathie.
            </p>
        </div>
    </div>
    <div class="flex gap-6 text-center justify-center lg:gap-12">
        @foreach ($reviews as $review)
            <div
                 class="@if ($loop->even) -translate-y-6 @endif w-full max-w-sm md:mb-0 border p-4 rounded-md shadow-md gs_reveal">
                <div class="mb-6 flex justify-center">
                    <div
                         class="bg-gradient-to-b from-primary-500 text-white to-primary-900 flex justify-center items-center text-5xl w-32 h-32 rounded-full shadow-lg dark:shadow-black/30">
                        {{ strtoupper(substr($review->name, 0, 1)) }}{{ strtoupper(substr($review->name, strrpos($review->name, ' ') + 1, 1)) }}
                    </div>
                </div>
                <h5 class="mb-4 text-xl font-semibold">
                    {{ $review->name }}
                </h5>
                <p class="mb-4">
                    <span class="fill-secondary-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-7 w-7 pr-2" viewBox="0 0 24 24">
                            <path
                                  d="M13 14.725c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275zm-13 0c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275z" />
                        </svg>
                    </span>
                    {{ $review->content }}
                </p>

                <div class="flex gap-1 justify-center fill-yellow-400">
                    @for ($i = 1; $i <= $review->value; $i++)
                        <x-icones.fullStar></x-icones.fullStar>
                    @endfor

                    @if (strpos($review->value, '.'))
                        <x-icones.halfStar></x-icones.halfStar>
                        @php $i++; @endphp
                    @endif

                    @for ($j = $i; $j <= 5; $j++)
                        <x-icones.emptyStar>
                        </x-icones.emptyStar>
                    @endfor

                </div>
            </div>
        @endforeach

    </div>
</div>
