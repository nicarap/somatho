<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content52b8e3000000" />
    
    <meta name="description" content="Explorez nos articles informatifs sur la Somatopathie. Restez informé(e) des dernières actualités et conseils pour votre bien-être physique et émotionnel.">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <title>Articles sur la Somatopathie - {{ $article->title }}</title>

    @vite('resources/css/app.css')
    @vite('resources/js/public.js')
</head>

<body class="text-gray-800 antialiased scroll-smooth">

    <main class="pb-20">
        <div class="bg-gradient-to-b from-primary-200 from-50% to-white">
            <nav class="navbar-fixed top-0 fixed z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 bg-primary-200/50 backdrop-blur-sm">
                <div class="container px-4 mx-auto flex flex-wrap items-center justify-between">
                    <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
                        <button class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none" type="button" onclick="toggleNavbar('example-collapse-navbar')">
                            <i class="text-white fas fa-bars"></i>
                        </button>
                    </div>
                    <div class="lg:flex flex-grow items-center bg-white lg:bg-transparent lg:shadow-none hidden">
                        <x-navigation />
                    </div>
                </div>
            </nav>
            
    <header class="relative pt-16 pb-32 flex content-center items-center justify-center" style="min-height: 75vh;">
        <div class="absolute top-0 w-full h-full bg-center bg-cover bg-fixed" style="background-image : url({{ asset('storage/'.$article->image) }})">
            <span id=" blackOverlay" class="w-full h-full absolute opacity-50 bg-gradient-to-b to-primary-800 from-black"></span>
        </div>
        <div class="container relative mx-auto">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-8/12 px-4 ml-auto mr-auto text-center">
                    <div class="flex items-center justify-center mx-auto pt-4">
                        <div class="fill-primary-300 aspect-auto w-16 mr-2">@include('logo.b')</div>
                        <h1 class="text-4xl font-semibold text-primary-300">{{ $article->title }}</h1>
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
            
            <section>
                <div class="max-w-7xl mx-auto w-full py-16 px-4">
                    <div class="bg-white shadow-md px-12 py-6 rounded-md">
                        <article class="prose-sm text-justify whitespace-pre-wrap">{!! $article->content !!}</article>
                    </div>
                </div>
            </section>
            
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