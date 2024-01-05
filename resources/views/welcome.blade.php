<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="shortcut icon" href="./assets/img/favicon.ico" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <title>Amélie Bonzi | Somatothérapeute</title>
    @vite('resources/css/app.css')
</head>

<body class="text-gray-800 antialiased scroll-smooth">
    <nav class="top-0 fixed z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 bg-primary-200/50 backdrop-blur-sm">
        <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
            <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
                <button class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none" type="button" onclick="toggleNavbar('example-collapse-navbar')">
                    <i class="text-white fas fa-bars"></i>
                </button>
            </div>
            <div class="lg:flex flex-grow items-center bg-white lg:bg-transparent lg:shadow-none hidden">
                <!-- <ul class="flex flex-col lg:flex-row list-none mr-auto">
                    <li class="flex items-center">
                        <a class="lg:text-white lg:hover:text-gray-300 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold" href="https://www.creative-tim.com/learning-lab/tailwind-starter-kit#/landing"><i class="lg:text-gray-300 text-gray-500 far fa-file-alt text-lg leading-lg mr-2"></i>
                            Docs</a>
                    </li>
                </ul> -->
                <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
                    <li class="flex items-center">
                        <a class="lg:text-primary-800 hover:text-primary-400 hover:underline duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" href="#somatopathy">
                            <span class="inline-block ml-2">Somatopathie</span>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <a class="lg:text-primary-800 hover:text-primary-400 hover:underline px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" href="#reasons">
                            <span class="inline-block ml-2">Pour qui ?</span>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <a class="lg:text-primary-800 hover:text-primary-400 hover:underline px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" href="#contact">
                            <span class="inline-block ml-2">Contact</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <div class="relative pt-16 pb-32 flex content-center items-center justify-center" style="min-height: 75vh;">
            <div class="absolute top-0 w-full h-full bg-center bg-cover bg-fixed background-poyet">
                <span id="blackOverlay" class="w-full h-full absolute opacity-50 bg-gradient-to-b to-primary-800 from-black"></span>
            </div>
            <div class="container relative mx-auto">
                <div class="items-center flex flex-wrap">
                    <div class="w-full lg:w-6/12 px-4 ml-auto mr-auto text-center">
                        <div class="pr-12">

                            <div class="flex flex-col items-center pt-4 gap-2">
                                <div class="fill-primary-300 aspect-auto" style="width:200px">@include('logo.b')</div>
                                <div class="fill-primary-300 aspect-auto" style="width:300px">@include('logo.name')</div>
                                <div class="fill-primary-300 my-4" style="width:300px">@include('logo.slogan')</div>
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
        </div>
        <section class="pb-20 bg-primary-200">
            <div class="container mx-auto px-4 -mt-24">
                <div class="flex flex-wrap">
                    <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center">
                        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                            <div class="px-4 py-5 flex-auto">
                                <div class="p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full text-secondary-600 bg-secondary-200">
                                    @svg('heroicon-m-squares-2x2')
                                </div>
                                <h6 class="text-xl font-semibold">Ostéopathie douce</h6>
                                <p class="mt-2 mb-4 text-gray-600">
                                    La somatopathie est une manipulation du corps sans cracking.
                                    Les gestes de corrections sont doux, sans violance pour le corps.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-4/12 px-4 text-center">
                        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                            <div class="px-4 py-5 flex-auto">
                                <div class="p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full text-primary-600 bg-primary-200">
                                    @svg('heroicon-s-chat-bubble-left-ellipsis')
                                </div>
                                <h6 class="text-xl font-semibold">Somatopathie : Quand le corps parle</h6>
                                <p class="mt-2 mb-4 text-gray-600">
                                    Issue de l'ostéopathie, la somatopathie est une thérapie manuelle douce dont le but est de soigner les maux de la mémoire et des sensations qui se sont incarnés physiquement. </p>
                            </div>
                        </div>
                    </div>
                    <div class="pt-6 w-full md:w-4/12 px-4 text-center">
                        <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                            <div class="px-4 py-5 flex-auto">
                                <div class="p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full text-ternary-600 bg-ternary-400">
                                    @svg('heroicon-s-shield-check')
                                </div>
                                <h6 class="text-xl font-semibold">Somatopathe diplômée</h6>
                                <p class="mt-2 mb-4 text-gray-600">
                                    Issu de l'école de somatopathie xxx.

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="pb-20 bg-primary-200" id="somatopathy">
            <x-somatotherapy></x-somatotherapy>
        </section>
        <section class="relative py-20" id="reasons">
            <div class="custom-shape-divider-top-1703755415" style="
                position: absolute;
                top: -1rem;
                left: 0;
                width: 100%;
                overflow: hidden;
                line-height: 0;
                transform: rotate(-1deg);
                ">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="fill-primary-200">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
                </svg>
            </div>
            <x-reasons></x-reasons>

        </section>
        <section class="pt-20 pb-48">
            <div class="container mx-auto px-4">
                <div class="flex flex-wrap justify-center text-center mb-24">
                    <div class="w-full lg:w-6/12 px-4">
                        <h2 class="text-4xl font-semibold">Avis des patients</h2>
                        <p class="mt-4 text-md leading-relaxed text-gray-600">
                            Quelques témoignanges des personnes qui m'ont fait confiance pour les aider au travers des soins somatopathiques.
                        </p>
                    </div>
                </div>

                <livewire:reviews></livewire:reviews>

            </div>
        </section>
        <section class="relative block bg-primary-200">
            <div class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20" style="height: 80px;">
                <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                    <polygon class="text-primary-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
            <x-traitment></x-traitment>
        </section>
        <section class="relative block pb-20 lg:pt-20 bg-primary-200" id="contact">
            <div class="relative block py-24 lg:pt-0 bg-primary-200">
                <livewire:contact></livewire:contact>
            </div>
        </section>
    </main>
    <x-footer></x-footer>
</body>
<script>
    function toggleNavbar(collapseID) {
        document.getElementById(collapseID).classList.toggle("hidden");
        document.getElementById(collapseID).classList.toggle("block");
    }
</script>

</html>