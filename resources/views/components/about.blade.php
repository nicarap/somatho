<section class="container mx-auto pt-20" aria-labelledby="about-title">
    <div class="flex flex-wrap flex-row-reverse sm:flex-row items-center">
        <figure class="w-10/12 xl:w-4/12 2xl:w-3/12 mr-auto ml-auto mt-8 md:mt-0 gs_reveal gs_reveal_fromLeft">
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg md:rounded-lg bg-primary-400">
                <img src="{{ asset('images/amelie-1200.webp') }}"
                     srcset="{{ asset('images/amelie-400.webp') }} 400w, {{ asset('images/amelie-800.webp') }} 800w, {{ asset('images/amelie-1200.webp') }} 1200w"
                     sizes="(max-width: 600px) 400px, (max-width: 1200px) 800px, (max-width: 1600px) 1200px"
                     alt="Photo de Amelie Bonzi, somatopathe à Tahiti"
                     loading="lazy"
                     class="w-full align-middle md:rounded-lg" />
            </div>
        </figure>

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
                    À propos de moi
                </h3>
            </div>
            <div
                 class="[&>p]:text-lg [&>p]:font-light [&>p]:leading-relaxed [&>p]:text-justify [&>p]:mb-4 [&>p]:text-gray-700">
                <p class="mt-4">
                    Je me présente <a href="https://www.instagram.com/abonzisomato/" target="_blank" rel="noopener"
                       class="font-bold text-primary-900 hover:underline mt-8">Amelie Bonzi</a>, thérapeute diplômée en
                    <strong class="font-bold">somatopathie</strong> de l'école <a href="https://www.somatopathie.com/"
                       class="font-bold text-primary-900 hover:underline mt-8" target="_blank" rel="noopener noreferrer">Pierre Camille Vernet</a>
                    en Métropole. Spécialiste en <strong class="font-bold">thérapie manuelle douce</strong>, je propose des soins adaptés pour soulager vos douleurs chroniques et aigües à Tahiti.
                </p>
                <p class="mt-0 hidden md:block">Passionnée par la découverte de nouvelles cultures et de <strong class="font-bold">techniques thérapeutiques
                    innovantes</strong> à travers le monde, j'ai exercé dans le sud de la France et sur l'île de La Réunion avant
                    de m'établir sur l'île de Tahiti. Cette richesse d'expériences multiculturelles m'a permis de développer une approche unique de la <strong class="font-bold">somatopathie</strong>.</p>
                <p class="mt-0">
                    Je m'engage à rétablir l'harmonie entre votre corps et votre esprit, en utilisant une approche
                    <strong class="font-bold">somatopathique</strong> alliant tradition et innovation.
                    Ma <strong class="font-bold">thérapie manuelle douce</strong> vise à traiter tant les <strong class="font-bold">douleurs physiques</strong> (dos, nuque, articulations) que les
                    <strong class="font-bold">troubles émotionnels</strong> (stress, anxiété, traumatismes), permettant un retour à l'équilibre global.
                </p>
                <p class="mt-0 hidden md:block">
                    Je vous ferai découvrir <a href="{{ route('somatopathy') }}"
                       class="font-bold text-primary-900 hover:underline mt-8">la Méthode Poyet</a>, une approche qui, en combinant
                    des <strong class="font-bold">techniques précises</strong> et une
                    compréhension
                    profonde du corps, offre une voie unique vers le <strong class="font-bold">bien-être global</strong>. Consultez-moi à <strong class="font-bold">Tahiti</strong> pour des soins personnalisés et efficaces adaptés à vos besoins spécifiques.
                </p>
            </div>
        </div>
    </div>
</section>
