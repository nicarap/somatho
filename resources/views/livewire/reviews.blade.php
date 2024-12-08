<div class="container mx-auto px-4 overflow-hidden py-24">
    <div class="flex flex-wrap justify-center text-center mb-8">
        <div class="w-full lg:w-6/12 px-4">
            <h2 class="text-5xl font-antiqua font-semibold text-primary-500">Avis des patients</h2>
            <p class="text-lg font-light leading-relaxed text-justify md:text-center mt-4 mb-4 text-gray-700">
                Découvres les témoignages inspirants à travers les retours authentiques des personnes qui m'ont fait
                confiance pour un soin en somatopathie.
            </p>
        </div>
    </div>
    <div class="flex gap-1 items-center justify-center">

        <button {{ $hasPrev ? '' : 'disabled' }} wire:click="prev" title="Précédent" aria-label="Précédent"
                class="hidden md:block w-8 h-8 {{ $hasPrev ? 'text-primary-900 hover:bg-primary-200 rounded-full hover:shadow-sm' : 'text-primary-200' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>

        </button>
        @php
            $grid = $reviews->count() === 1 ? 'grid-cols-1' : ($reviews->count() === 2 ? 'grid-cols-2' : 'grid-cols-3');
        @endphp
        <div class="grid md:{{ $grid }} gap-6 text-center justify-center lg:gap-12">
            @foreach ($reviews as $review)
                <div class="mx-auto max-w-xl flex items-center justify-evenly w-full">
                    <div class="p-8 h-full bg-primary-900 max-w-xs text-gray-200 rounded-xl z-40 w-full">
                        <div class="flex h-full flex-col justify-between">

                            <h5 class="mb-4 text-xl font-semibold">
                                {{ $review->name }}
                            </h5>


                            <p>
                                <span class="fill-primary-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="inline-block h-7 w-7 pr-2"
                                         viewBox="0 0 24 24">
                                        <path
                                              d="M13 14.725c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275zm-13 0c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275z" />
                                    </svg>
                                </span>
                                {{ $review->content }}
                            </p>

                            <div class="flex gap-1 pt-4 justify-center fill-yellow-400 ">
                                @for ($i = 1; $i <= $review->value; $i++)
                                    @if ($i < 5)
                                        <x-icones.fullStar></x-icones.fullStar>
                                    @endif
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
                    </div>
                </div>
            @endforeach
        </div>
        <button {{ $hasNext ? '' : 'disabled' }} wire:click="next" title="Suivant" aria-label="Suivant"
                class="hidden md:block w-8 h-8 {{ $hasNext ? 'text-primary-900 hover:bg-primary-200 rounded-full hover:shadow-sm' : 'text-primary-200' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                 stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </button>
    </div>
    <div class="w-full flex gap-4 justify-center md:hidden py-4">
        <button {{ $hasPrev ? '' : 'disabled' }} wire:click="prev" title="Précédent" aria-label="Précédent"
                class=" w-8 h-8 {{ $hasPrev ? 'text-primary-900 hover:bg-primary-200 rounded-full hover:shadow-sm' : 'text-primary-200' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
            </svg>
        </button>

        <button {{ $hasNext ? '' : 'disabled' }} wire:click="next" title="Suivant" aria-label="Suivant"
                class="w-8 h-8 {{ $hasNext ? 'text-primary-900 hover:bg-primary-200 rounded-full hover:shadow-sm' : 'text-primary-200' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                 stroke="currentColor">
                <path strokeLinecap="round" strokeLinejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
            </svg>
        </button>
    </div>
    <div class="flex flex-wrap justify-center text-center mb-8">
        <div class="w-full lg:w-6/12 px-4">
            <p class="text-lg font-light leading-relaxed text-justify md:text-center mt-4 mb-4 text-gray-700">
                N'hésitez pas à venir me donner votre avis sur ma page
                <x-link
                        url="https://www.google.fr/maps/place/Maita'i+Somatopathie/@-17.5308437,-149.5309131,12.75z/data=!4m6!3m5!1s0x837b174e2674069:0xfe41cf6d871fbd54!8m2!3d-17.557143!4d-149.5554012!16s%2Fg%2F11st_y8vr2?entry=ttu&g_ep=EgoyMDI0MTIwNC4wIKXMDSoASAFQAw%3D%3D"><x-slot
                            name="label">Google !</x-slot></x-link>
            </p>
        </div>
    </div>
</div>
