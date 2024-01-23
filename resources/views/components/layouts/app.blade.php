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
    <meta name="description" content="{{ $description }}">

    <!-- OG Meta Tags to improve the way the post looks when you share the page on Facebook, Twitter, LinkedIn -->
    <meta property="og:site_name" content="{{ $title }}" /> <!-- website name -->
    <meta property="og:locale" content="fr_FR"> <!-- website locale -->
    <meta property="og:title" content="{{ $title }}" /> <!-- title shown in the actual shared post -->
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ asset('favicon.png') }}">
    <meta property="og:image:width" content="2000">
    <meta property="og:image:height" content="1333">
    <meta property="og:image:type" content="image/png">

    <meta property="og:type" content="article">
    <meta property="article:publisher" content="https://www.instagram.com/abonzisomato/">

    <meta property="og:url" content="{{ env('APP_URL') }}" /> <!-- where do you want your post to link to -->
    <meta name="twitter:card" content="summary_large_image" /> <!-- to have large image post format in Twitter -->


    <title>{{ $title }}</title>

    @vite('resources/css/app.css')
    @vite('resources/js/public.js')
</head>

<body class="text-gray-800 antialiased scroll-smooth">

    <nav
         class="navbar-fixed group top-0 fixed z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 aria-[fixed=false]:bg-primary-900 transition-all duration-300">
        <div class="container px-4 mx-auto flex flex-wrap items-center justify-between gap-16">
            <div class="w-full relative flex justify-between lg:w-auto lg:static lg:block lg:justify-start">
                <button class="cursor-pointer text-xl leading-none px-3 py-1 border border-solid border-transparent rounded bg-transparent block lg:hidden outline-none focus:outline-none"
                        type="button" onclick="toggleNavbar('example-collapse-navbar')">
                    <i class="text-white fas fa-bars"></i>
                </button>

                <div class="fill-secondary-500 aspect-auto w-12">@include('logo.b')</div>
            </div>
            <div class="lg:flex flex-1 flex-grow items-center bg-white lg:bg-transparent lg:shadow-none hidden">
                <x-navigation />
            </div>
            <div class="lg:flex items-center justify-end bg-white lg:bg-transparent lg:shadow-none hidden">
                <a href="#contact"
                   class="bg-secondary-500 text-gray-600 active:bg-primary-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 transition-all duration-300"
                   type="submit" style="transition: all 0.15s ease 0s;">
                    Prendre contact
                </a>
            </div>
        </div>
    </nav>
    <header class="relative pt-16 pb-16 flex content-center items-center justify-center" style="min-height: 90vh;"
            id="home">
        <div class="absolute top-0 w-full h-full bg-cover bg-center bg-fixed"
             style="background-image: url(@if (isset($image)) {{ asset('storage/' . $image) }} @else {{ asset('images/DSC_0593.jpg') }} @endif)">
            <span id=" blackOverlay"
                  class="w-full h-full absolute opacity-50 bg-gradient-to-b backdrop-blur-sm to-primary-900 from-black"></span>
        </div>
        <div class="container relative mx-auto -mt-16">
            <div class="items-center flex flex-wrap">
                <div class="w-full lg:w-8/12 mx-auto">
                    <div class="flex flex-col items-center gap-2">
                        {{ $mainTitle }}
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
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
