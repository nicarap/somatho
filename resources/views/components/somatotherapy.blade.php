<div class="container mx-auto pt-20 relative z-10">
    <div class="flex flex-wrap items-center">
        <div class="w-full xl:w-6/12 2xl:w-5/12  px-4 mr-auto ml-auto gs_reveal gs_reveal_fromLeft">
            <div
                 class="fill-primary-900 p-3 border-2 bg-primary-200 z-10 border-primary-900 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-2/3" viewBox="0 0 576 512">
                    <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                    <path
                          d="M183.1 235.3c33.7 20.7 62.9 48.1 85.8 80.5c7 9.9 13.4 20.3 19.1 31c5.7-10.8 12.1-21.1 19.1-31c22.9-32.4 52.1-59.8 85.8-80.5C437.6 207.8 490.1 192 546 192h9.9c11.1 0 20.1 9 20.1 20.1C576 360.1 456.1 480 308.1 480H288 267.9C119.9 480 0 360.1 0 212.1C0 201 9 192 20.1 192H30c55.9 0 108.4 15.8 153.1 43.3zM301.5 37.6c15.7 16.9 61.1 71.8 84.4 164.6c-38 21.6-71.4 50.8-97.9 85.6c-26.5-34.8-59.9-63.9-97.9-85.6c23.2-92.8 68.6-147.7 84.4-164.6C278 33.9 282.9 32 288 32s10 1.9 13.5 5.6z" />
                </svg>

            </div>
            <h3 class="text-5xl font-antiqua mb-2 font-semibold leading-normal text-primary-900">
                La Somatopathie
            </h3>
            <div
                 class="[&>p]:text-lg [&>p]:font-light [&>p]:leading-relaxed [&>p]:text-justify [&>p]:mb-4 [&>p]:text-gray-700">
                <p class="mt-0">
                    La somatopathie, souvent méconnue, offre une approche unique pour comprendre et harmoniser les liens
                    entre nos émotions,
                    notre corps et notre bien-être global. Que tu sois novice en la matière ou que tu ais déjà
                    consulté(e),
                    ce site est conçu pour te guider à chaque étape.
                </p>
                <p class="mt-4">
                    Imagine un moyen de renforcer la connexion entre ton corps et ton esprit,
                    de libérer des tensions cumulées, les traumatismes et d'atteindre un équilibre profond et durable.
                    La somatopathie offre précisément cela, en utilisant des techniques manuelle douce qui intègrent 
                    mouvements, rééquilibrage, psychologie et conscience corporelle.
                </p>
                <p class="mt-4">
                    Prêt(e) à plonger dans l'univers captivant de la somatopathie ?
                    Je t'invite à cliquer sur le bouton ci-dessous pour en apprendre davantage.
                </p>
            </div>
            <div class="mt-8">
                <x-button url="{{ route('somatopathy') }}">
                    <x-slot name="label">En savoir plus</x-slot>
                </x-button>
            </div>
        </div>
        <div class="w-8/12 xl:w-4/12 2xl:w-3/12 mr-auto ml-auto mt-8 md:mt-0 gs_reveal gs_reveal_fromRight">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-primary-200">
                <img alt="MRP" src="{{ asset('images/somato.jpg') }}" class="w-full align-middle rounded" />
            </div>
        </div>
    </div>
</div>

@push('images')
<link rel="preload" type="image/png" href="{{ asset('images/somato.jpg') }}" as="image"/>
@endpush
