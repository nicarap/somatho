<div class="container mx-auto pt-20">
    <div class="px-4 sm:hidden">
        <div
             class="fill-primary-900 p-3 border-2 border-primary-900 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-primary-50">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-2/3" viewBox="0 0 576 512">
                <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                <path
                      d="M183.1 235.3c33.7 20.7 62.9 48.1 85.8 80.5c7 9.9 13.4 20.3 19.1 31c5.7-10.8 12.1-21.1 19.1-31c22.9-32.4 52.1-59.8 85.8-80.5C437.6 207.8 490.1 192 546 192h9.9c11.1 0 20.1 9 20.1 20.1C576 360.1 456.1 480 308.1 480H288 267.9C119.9 480 0 360.1 0 212.1C0 201 9 192 20.1 192H30c55.9 0 108.4 15.8 153.1 43.3zM301.5 37.6c15.7 16.9 61.1 71.8 84.4 164.6c-38 21.6-71.4 50.8-97.9 85.6c-26.5-34.8-59.9-63.9-97.9-85.6c23.2-92.8 68.6-147.7 84.4-164.6C278 33.9 282.9 32 288 32s10 1.9 13.5 5.6z" />
            </svg>

        </div>
        <h3 class="text-5xl font-antiqua mb-2 font-semibold leading-normal text-primary-900">
            A propos de moi
        </h3>
    </div>

    <div class="flex flex-wrap flex-row-reverse sm:flex-row items-center">

        <div class="w-8/12 xl:w-4/12 2xl:w-3/12 mr-auto ml-auto mt-8 md:mt-0 gs_reveal gs_reveal_fromLeft">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg md:rounded-lg bg-primary-400">
                <img alt="Photo de Amelie Bonzi" src="{{ asset('images/amelie.jpg') }}"
                     class="w-full align-middle md:rounded-lg" />
            </div>
        </div>

        <div class="w-full xl:w-6/12 2xl:w-5/12 px-4 mr-auto ml-auto gs_reveal gs_reveal_fromRight">
            <div class="hidden sm:block">
                <div
                     class="fill-primary-900 p-3 border-2 border-primary-900 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-primary-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-2/3" viewBox="0 0 576 512">
                        <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                              d="M183.1 235.3c33.7 20.7 62.9 48.1 85.8 80.5c7 9.9 13.4 20.3 19.1 31c5.7-10.8 12.1-21.1 19.1-31c22.9-32.4 52.1-59.8 85.8-80.5C437.6 207.8 490.1 192 546 192h9.9c11.1 0 20.1 9 20.1 20.1C576 360.1 456.1 480 308.1 480H288 267.9C119.9 480 0 360.1 0 212.1C0 201 9 192 20.1 192H30c55.9 0 108.4 15.8 153.1 43.3zM301.5 37.6c15.7 16.9 61.1 71.8 84.4 164.6c-38 21.6-71.4 50.8-97.9 85.6c-26.5-34.8-59.9-63.9-97.9-85.6c23.2-92.8 68.6-147.7 84.4-164.6C278 33.9 282.9 32 288 32s10 1.9 13.5 5.6z" />
                    </svg>

                </div>
                <h3 class="text-5xl mb-2 font-antiqua font-semibold leading-normal text-primary-900">
                    A propos de moi
                </h3>
            </div>
            <div
                 class="[&>p]:text-lg [&>p]:font-light [&>p]:leading-relaxed [&>p]:text-justify [&>p]:mb-4 [&>p]:text-gray-700">
                <p class="mt-4">
                    Je me présente <a href="https://www.instagram.com/abonzisomato/" target="_blank" rel="noopener"
                       class="font-bold text-primary-900 hover:underline mt-8">Amelie Bonzi</a>, thérapeute diplômée en
                    somatopathie de l'école <a href="https://www.somatopathie.com/"
                       class="font-bold text-primary-900 hover:underline mt-8" target="_blank">Pierre Camille Vernet</a>
                    en Métropole.
                </p>
                <p class="mt-0">Passionnée par la découverte de nouvelles cultures et de techniques thérapeutiques
                    innovantes à travers le monde, j'ai exercé dans le sud de la France et sur l'île de La Réunion avant
                    de poursuivre mon travail sur l'île de Tahiti.</p>
                <p class="mt-0">
                    Je m'engage à rétablir l'harmonie entre votre corps et votre esprit, en utilisant une approche
                    somatopathique alliant tradition et innovation.

                    Je pratique une thérapie manuelle douce visant à traiter tant les douleurs physiques que les
                    troubles
                    émotionnels
                </p>
                <p class="mt-0">
                    Je vous ferez découvrir <a href="{{ route('somatopathy') }}"
                       class="font-bold text-primary-900 hover:underline mt-8">La Méthode Poyet</a> qui, en combinant
                    des techniques
                    précises et une
                    compréhension
                    profonde du corps, offre une voie unique vers le bien-être global
                </p>
            </div>
        </div>
    </div>
</div>
