<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="theme-color" content52b8e3000000" />
        
        <meta name="description" content="Découvrez l'histoire et la passion qui sous-tendent ma pratique en somatopathie. Amelie Bonzi, thérapeute dévouée, vous guide vers l'équilibre physique et émotionnel avec la méthode POYET.">
        <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />
    
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
        <title>A propos de moi - Amélie Bonzi</title>
    
        @vite('resources/css/app.css')
        @vite('resources/js/public.js')
    </head>
    
    <body class="text-gray-800 antialiased scroll-smooth">
    
        <main>
            <div class="bg-gradient-to-b from-primary-200 from-50% to-white">
                <nav class="navbar-fixed group top-0 fixed z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 aria-[fixed=false]:bg-primary-900 transition-all duration-300">
                    <div class="container px-4 mx-auto flex flex-wrap items-center justify-between gap-16">
                        <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
                            <button class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none" type="button" onclick="toggleNavbar('example-collapse-navbar')">
                                <i class="text-white fas fa-bars"></i>
                            </button>
                            
                            <div class="fill-secondary-50 aspect-auto w-12">@include('logo.b')</div>
                        </div>
                        <div class="lg:flex flex-1 flex-grow items-center bg-white lg:bg-transparent lg:shadow-none hidden">
                            <x-navigation />
                        </div>
                        <div class="lg:flex items-center justify-end bg-white lg:bg-transparent lg:shadow-none hidden">
                            <a href="{{ route('home') }}/#contact" class="bg-secondary-500 text-white active:bg-primary-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="submit" style="transition: all 0.15s ease 0s;">
                                Prendre contact
                            </a>
                        </div>
                    </div>
                </nav>
                
                <header class="relative pt-16 pb-16 flex content-center items-center justify-center" style="min-height: 100vh;"  id="home">
                    <div class="absolute top-0 w-full h-full bg-cover bg-bottom bg-fixed background-poyet">
                        <span id=" blackOverlay" class="w-full h-full absolute opacity-50 bg-gradient-to-b backdrop-blur-sm to-primary-900 from-black"></span>
                    </div>
                    <div class="container relative mx-auto">
                        <div class="items-center flex flex-wrap">
                            <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                                <div class="pr-12">
            
                                    <div class="flex flex-col items-center pt-4 gap-2">
                                        <h1 class="text-7xl font-serif font-light leading-relaxed mt-4 mb-4 text-secondary-50">
                                            A propos de moi
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden" style="height: 70px;">
                        <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                            <polygon class="text-primary-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
                        </svg>
                    </div>
                </header>

                <section class="pb-20 bg-primary-200" id="about">
                    
                    <div class="container mx-auto px-4 pt-20">
                        <div class="flex flex-wrap items-center">
                            
                            <div class="w-full md:w-3/12 px-4 mr-auto ml-auto  gs_reveal gs_reveal_fromLeft">
                                <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-primary-400">
                                    <img alt="soin_sur_genou_amelie_bonzi" src="{{ asset('images/soin_sur_genou_amelie_bonzi.jpg') }}" class="w-full align-middle rounded-lg" style="height: 500px;" />
                                    {{-- <blockquote class="relative p-8 mb-4">
                                        <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 583 95" class="absolute left-0 w-full block" style="height: 95px; top: -94px;">
                                            <polygon points="-30,95 583,95 583,65" class="text-primary-400 fill-current"></polygon>
                                        </svg>
                                        <h4 class="text-xl font-bold text-white">
                                            Séance de somatopathie !
                                        </h4>
                                        <p class="text-md font-light mt-2 text-white">
                                            La séance débute par un échange approfondi avec le patient afin de comprendre ses attentes et besoins. 
                                            Ensuite, le traitement commence par l'identification des problèmes, 
                                            suivi de l'application de techniques manuelles douces visant à libérer les tensions et à rétablir l'équilibre.
                                        </p>
                                    </blockquote> --}}
                                </div>
                            </div>
                    
                            <div class="w-full md:w-5/12 px-4 mr-auto ml-auto gs_reveal gs_reveal_fromRight">
                                <div class="fill-primary-500 p-3 border-2 border-primary-500 text-center inline-flex items-center justify-center w-16 h-16 mb-6 shadow-lg rounded-full bg-primary-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-2/3" viewBox="0 0 576 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path d="M183.1 235.3c33.7 20.7 62.9 48.1 85.8 80.5c7 9.9 13.4 20.3 19.1 31c5.7-10.8 12.1-21.1 19.1-31c22.9-32.4 52.1-59.8 85.8-80.5C437.6 207.8 490.1 192 546 192h9.9c11.1 0 20.1 9 20.1 20.1C576 360.1 456.1 480 308.1 480H288 267.9C119.9 480 0 360.1 0 212.1C0 201 9 192 20.1 192H30c55.9 0 108.4 15.8 153.1 43.3zM301.5 37.6c15.7 16.9 61.1 71.8 84.4 164.6c-38 21.6-71.4 50.8-97.9 85.6c-26.5-34.8-59.9-63.9-97.9-85.6c23.2-92.8 68.6-147.7 84.4-164.6C278 33.9 282.9 32 288 32s10 1.9 13.5 5.6z" />
                                    </svg>
                    
                                </div>
                                <h3 class="text-3xl mb-2 font-semibold leading-normal">
                                    A propos de moi
                                </h3>
                                <p class="text-lg font-light leading-relaxed mt-4 mb-4 text-gray-700">
                                    Je suis <a href="https://www.instagram.com/abonzisomato/" class="font-bold text-primary-900 hover:underline mt-8">Amelie Bonzi</a>, thérapeute en somatopathie. Je m'engage à rétablir l'harmonie entre votre corps et votre esprit, en utilisant une approche holistique alliant tradition et innovation.
                                <p class="text-lg font-light leading-relaxed mt-0 mb-4 text-gray-700">
                                    Je vous accueille au sein du Centre de Santé <a href="https://www.secondeviereunion.com/" class="font-bold text-primary-900 hover:underline mt-8">Seconde Vie</a> jusqu'à mars 2024, où j'applique une approche manuelle douce visant à traiter tant les douleurs physiques que les troubles émotionnels
                                </p>
                                <p class="text-lg font-light leading-relaxed mt-0 mb-4 text-gray-700">
                                    Je vous ferez découvrir la méthode Poyet qui, en combinant des techniques précises et une compréhension profonde du corps, offre une voie unique vers le bien-être global
                                </p>
                            </div>
                        </div>
                    </div>

                </section>
            </div>
        </main>
        <x-footer></x-footer>
    </body>    
</html>