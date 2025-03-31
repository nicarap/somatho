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
                La Somatopathie - Thérapie Manuelle Douce
            </h3>
            <div
                 class="[&>p]:text-lg [&>p]:font-light [&>p]:leading-relaxed [&>p]:text-justify [&>p]:mb-4 [&>p]:text-gray-700">
                <p class="mt-0">
                    <strong class="font-bold">La somatopathie</strong>, thérapie manuelle encore souvent méconnue à <strong class="font-bold">Tahiti</strong>, offre une approche unique pour comprendre et harmoniser les liens
                    entre nos <strong class="font-bold">émotions</strong>,
                    notre <strong class="font-bold">corps</strong> et notre <strong class="font-bold">bien-être global</strong>. <span class="hidden md:block">Que vous souffriez de <strong class="font-bold">douleurs chroniques</strong>, de <strong class="font-bold">troubles du sommeil</strong> ou de <strong class="font-bold">stress</strong>, cette méthode peut vous aider à retrouver équilibre et vitalité.</span></span>
                </p>
                <p class="mt-4">
                    Imaginez un <strong class="font-bold">traitement naturel</strong> capable de renforcer la connexion entre votre corps et votre esprit,
                    de libérer les <strong class="font-bold">tensions accumulées</strong>, les <strong class="font-bold">traumatismes émotionnels</strong> et d'atteindre un équilibre profond et durable.
                    <span class="hidden md:block">La somatopathie offre précisément cela, en utilisant des techniques manuelles douces qui intègrent 
                    mouvements, <strong class="font-bold">rééquilibrage énergétique</strong>, psychologie et <strong class="font-bold">conscience corporelle</strong>.</span>
                </p>
                <p class="mt-4">
                <span class="hidden md:block"><strong class="font-bold">À Tahiti</strong>, je propose des <strong class="font-bold">consultations personnalisées</strong> adaptées à vos besoins spécifiques.
                    La <strong class="font-bold">Méthode Poyet</strong> que j'utilise s'adresse aussi bien aux <strong class="font-bold">adultes</strong> qu'aux <strong class="font-bold">enfants</strong> et peut soulager de nombreux maux comme les <strong class="font-bold">douleurs de dos</strong>, les <strong class="font-bold">migraines</strong>, ou les <strong class="font-bold">troubles digestifs</strong>.</span>
                    Prêt(e) à découvrir cette approche thérapeutique et à retrouver votre équilibre naturel ?
                    Je vous invite à cliquer sur le bouton ci-dessous pour en apprendre davantage.
                </p>
            </div>
            <div class="mt-8">
                <x-button url="{{ route('somatopathy') }}">
                    <x-slot name="label">En savoir plus</x-slot>
                </x-button>
            </div>
        </div>
        <div class="w-10/12 xl:w-4/12 2xl:w-3/12 mr-auto ml-auto mt-8 md:mt-0 gs_reveal gs_reveal_fromRight">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-primary-200">
                <img src="{{ asset('images/somato-1200.webp') }}"
                     srcset="{{ asset('images/somato-400.webp') }} 400w, {{ asset('images/somato-800.webp') }} 800w"
                     sizes="(max-width: 600px) 400px, (max-width: 1200px) 800px, (max-width: 1600px) 1200px"
                     alt="Photo de Amelie Bonzi" class="w-full align-middle rounded" />
            </div>
        </div>
    </div>
</div>
