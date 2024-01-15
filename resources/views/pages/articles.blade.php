<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#52b8e3" />
    
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <meta name="author" content="Amélie Bonzi" />
    <meta name="description" content="Amélie Bonzi, somatothérapeute dévouée à votre bien-être. Découvrez les bienfaits de la somatopathie pour une vie équilibrée et harmonieuse.">
    
    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
    <meta property="og:site_name" content="Amélie Bonzi - Thérapeute en somatopathie" /> <!-- website name -->
    <meta property="og:locale" content="fr_FR"> <!-- website locale -->
    <meta property="og:title" content="Amélie Bonzi - Thérapeute en somatopathie" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="Amélie Bonzi, somatothérapeute dévouée à votre bien-être. Découvrez les bienfaits de la somatopathie pour une vie équilibrée et harmonieuse.">
    <meta property="og:image" content="{{ asset('favicon.png') }}">
    <meta property="og:image:width" content="2000">
    <meta property="og:image:height" content="1333">
    <meta property="og:image:type" content="image/png">

    <meta property="og:type" content="article">
    <meta property="article:publisher" content="https://www.instagram.com/abonzisomato/">

    <meta property="og:url" content="{{ env('APP_URL') }}" /> <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="summary_large_image" /> <!-- to have large image post format in Twitter -->


    <title>Amélie Bonzi - Thérapeute en somatopathie</title>

    @vite('resources/css/app.css')
    @vite('resources/js/public.js')
</head>

<body class="text-gray-800 antialiased scroll-smooth">

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
        <header class="relative pt-16 pb-32 flex content-center items-center justify-center" style="min-height: 75vh;">
            <div class="absolute top-0 w-full h-full bg-center bg-cover bg-fixed background-poyet">
                <span id=" blackOverlay" class="w-full h-full absolute opacity-50 bg-gradient-to-b to-primary-800 from-black"></span>
            </div>
            <div class="container relative mx-auto">
                <div class="items-center flex flex-wrap">
                    <div class="w-full lg:w-8/12 px-4 ml-auto mr-auto text-center">
                        <div class="flex items-center justify-center mx-auto pt-4">
                            <div class="fill-primary-300 aspect-auto w-16 mr-2">@include('logo.b')</div>
                            <h1 class="text-4xl font-semibold text-primary-300">Mes articles</h1>
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
        
        <div class="bg-gradient-to-b from-primary-200 from-50% to-white">
            <div class="container mx-auto py-12 px-4">
                
            <div class="flex flex-wrap justify-center text-center">
                <div class="w-full max-w-7xl px-4">
                    <h2 class="text-4xl font-semibold uppercase text-primary-400">Articles</h2>
                    <p class="text-lg leading-relaxed mt-4 mb-4 text-gray-500">
                        Explorez l'ensemble des publications dédiées à la somatopathie. 
                        Plongez au cœur de cette thérapie douce, découvrez des conseils précieux pour améliorer votre bien-être physique et émotionnel.
                    </p>
                </div>
            </div>
            
                <livewire:articles :articles="App\Models\Article::published()->orderBy('published_at')->get()" />
            </div>
        </div>
    </div>

    <x-footer></x-footer>
</body>
</html>