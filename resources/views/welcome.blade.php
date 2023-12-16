<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <link rel="shortcut icon" href="./assets/img/favicon.ico" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <title>Amélie Bonzi | Somatothérapeute</title>
    @vite('resources/css/app.css')
</head>

<body class="text-gray-800 antialiased scroll-smooth">
    <nav class="top-0 absolute z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 ">
        <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
            <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
                <button class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none" type="button" onclick="toggleNavbar('example-collapse-navbar')">
                    <i class="text-white fas fa-bars"></i>
                </button>
            </div>
            <div class="lg:flex flex-grow items-center bg-white lg:bg-transparent lg:shadow-none hidden" id="example-collapse-navbar">
                <!-- <ul class="flex flex-col lg:flex-row list-none mr-auto">
                    <li class="flex items-center">
                        <a class="lg:text-white lg:hover:text-gray-300 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold" href="https://www.creative-tim.com/learning-lab/tailwind-starter-kit#/landing"><i class="lg:text-gray-300 text-gray-500 far fa-file-alt text-lg leading-lg mr-2"></i>
                            Docs</a>
                    </li>
                </ul> -->
                <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
                    <li class="flex items-center">
                        <a class="lg:text-white hover:underline duration-100 transition-all lg:hover:text-gray-300 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold" href="#contact">
                            <span class="inline-block ml-2">Somatopathie</span>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <a class="lg:text-white lg:hover:text-gray-300 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold" href="#contact">
                            <span class="inline-block ml-2">Pour qui ?</span>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <a class="lg:text-white lg:hover:text-gray-300 text-gray-800 px-3 py-4 lg:py-2 flex items-center text-xs uppercase font-bold" href="#contact">
                            <span class="inline-block ml-2">Contact</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main class="scroll-smooth">
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
        <section class="pb-20 bg-primary-200 -mt-24">
            <x-somatotherapy></x-somatotherapy>
        </section>
        <section class="relative py-20">
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
                        <h2 class="text-4xl font-semibold">Avis des consommateurs</h2>
                        <p class="mt-4 text-md leading-relaxed text-gray-600">
                            Quelque soit la difficulté que vous rencontrez, la méthode s'adresse à tous.
                            Aussi bien à des nouveaux nés, des personnes âgées, des femmes enceintes
                            qu'à des grands sportifs ou tout autre adulte…
                        </p>
                    </div>
                </div>

                <div class="grid gap-6 text-center md:grid-cols-3 lg:gap-12">
                    <div class="mb-12 md:mb-0">
                        <div class="mb-6 flex justify-center">
                            <img src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20(1).jpg" class="w-32 rounded-full shadow-lg dark:shadow-black/30" />
                        </div>
                        <h5 class="mb-4 text-xl font-semibold">Maria Smantha</h5>
                        <h6 class="mb-4 font-semibold text-primary dark:text-primary-500">
                            Web Developer
                        </h6>
                        <p class="mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="inline-block h-7 w-7 pr-2" viewBox="0 0 24 24">
                                <path d="M13 14.725c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275zm-13 0c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275z" />
                            </svg>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod eos
                            id officiis hic tenetur quae quaerat ad velit ab hic tenetur.
                        </p>
                        <ul class="mb-0 flex items-center justify-center">
                            <li>
                                <x-icones.fullStar></x-icones.fullStar>
                            </li>
                            <li>
                                <x-icones.fullStar></x-icones.fullStar>
                            </li>
                            <li>
                                <x-icones.fullStar></x-icones.fullStar>
                            </li>
                            <li>
                                <x-icones.emptyStar></x-icones.emptyStar>
                            </li>
                            <li>
                                <x-icones.emptyStar></x-icones.emptyStar>
                            </li>
                        </ul>
                    </div>

                    <div class="mb-12 md:mb-0">
                        <div class="mb-6 flex justify-center">
                            <img src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20(2).jpg" class="w-32 rounded-full shadow-lg dark:shadow-black/30" />
                        </div>
                        <h5 class="mb-4 text-xl font-semibold">Lisa Cudrow</h5>
                        <h6 class="mb-4 font-semibold text-primary dark:text-primary-500">
                            Graphic Designer
                        </h6>
                        <p class="mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="inline-block h-7 w-7 pr-2" viewBox="0 0 24 24">
                                <path d="M13 14.725c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275zm-13 0c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275z" />
                            </svg>
                            Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis
                            suscipit laboriosam, nisi ut aliquid commodi.
                        </p>
                        <ul class="mb-0 flex items-center justify-center">
                            <li>
                                <x-icones.fullStar></x-icones.fullStar>
                            </li>
                            <li>
                                <x-icones.fullStar></x-icones.fullStar>
                            </li>
                            <li>
                                <x-icones.fullStar></x-icones.fullStar>
                            </li>
                            <li>
                                <x-icones.fullStar></x-icones.fullStar>
                            </li>
                            <li>
                                <x-icones.halfStar></x-icones.halfStar>
                            </li>
                        </ul>
                    </div>

                    <div class="mb-0">
                        <div class="mb-6 flex justify-center">
                            <img src="https://tecdn.b-cdn.net/img/Photos/Avatars/img%20(9).jpg" class="w-32 rounded-full shadow-lg dark:shadow-black/30" />
                        </div>
                        <h5 class="mb-4 text-xl font-semibold">John Smith</h5>
                        <h6 class="mb-4 font-semibold text-primary dark:text-primary-400">
                            Marketing Specialist
                        </h6>
                        <p class="mb-4 text-neutral-600 dark:text-neutral-300">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="inline-block h-7 w-7 pr-2" viewBox="0 0 24 24">
                                <path d="M13 14.725c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275zm-13 0c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275z" />
                            </svg>
                            Ut enim ad minima veniam, quis nostrum exercitationem ullam
                            corporis suscipit laboriosam, nisi ut aliquid commodi.
                        </p>
                        <ul class="mb-0 flex items-center justify-center">
                            <li>
                                <x-icones.fullStar></x-icones.fullStar>
                            </li>
                            <li>
                                <x-icones.fullStar></x-icones.fullStar>
                            </li>
                            <li>
                                <x-icones.fullStar></x-icones.fullStar>
                            </li>
                            <li>
                                <x-icones.fullStar></x-icones.fullStar>
                            </li>
                            <li>
                                <x-icones.emptyStar></x-icones.emptyStar>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="pb-20 relative block bg-primary-200" id="contact">
            <div class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20" style="height: 80px;">
                <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                    <polygon class="text-primary-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
            <x-traitment></x-traitment>
        </section>
        <section class="relative block py-24 lg:pt-0 bg-primary-200">
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