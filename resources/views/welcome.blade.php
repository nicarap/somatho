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
    @vite('resources/js/public.js')
</head>

<body class="text-gray-800 antialiased scroll-smooth">
    <nav class="navbar-fixed top-0 fixed z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 bg-primary-200/50 backdrop-blur-sm">
        <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
            <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
                <button class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none" type="button" onclick="toggleNavbar('example-collapse-navbar')">
                    <i class="text-white fas fa-bars"></i>
                </button>
            </div>
            <div class="lg:flex flex-grow items-center bg-white lg:bg-transparent lg:shadow-none hidden">
                <ul class="flex flex-col lg:flex-row list-none lg:ml-auto">
                    <li class="flex items-center">
                        <a class="lg:text-primary-800 hover:text-primary-400 hover:underline duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" href="{{ str_contains(url()->current(), 'articles') ? route('home') :'#somatopathy' }}">
                            <span class="inline-block ml-2">Somatopathie</span>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <a class="lg:text-primary-800 hover:text-primary-400 hover:underline px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" href="{{ str_contains(url()->current(), 'articles') ? route('home') :'#reasons' }}">
                            <span class="inline-block ml-2">Pour qui ?</span>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <a class="lg:text-primary-800 hover:text-primary-400 hover:underline px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" href="{{ str_contains(url()->current(), 'articles') ? route('home') :'#contact' }}">
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