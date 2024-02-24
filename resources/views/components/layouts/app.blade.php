<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-57V5T79GXJ"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-57V5T79GXJ');
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-NCHRQ4X9');
    </script>
    <!-- End Google Tag Manager -->

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

    @livewireScripts
    @livewireStyles
</head>

<body class="text-gray-800 antialiased scroll-smooth">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NCHRQ4X9" height="0" width="0"
                style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <nav
         class="navbar-fixed h-20 group top-0 fixed z-50 w-full flex flex-wrap items-center justify-between px-2 py-3 aria-[fixed=false]:bg-primary-900 fill-primary-500 aria-[fixed=false]:fill-secondary-900 transition-all duration-300">
        <div class="container px-4 mx-auto flex flex-wrap items-center justify-between gap-16">
            <div class="w-full relative flex justify-between xl:w-auto xl:static xl:block xl:justify-start">
                <div class="fill-secondary-500 aspect-auto w-12">@include('logo.b')</div>

                <button class="cursor-pointer text-xl fill-secondary-500 leading-none px-3 py-1 w-14 border border-solid border-transparent rounded bg-transparent block xl:hidden outline-none focus:outline-none"
                        type="button" id="openNavbar">
                    <svg class="h-full w-full" viewBox="-2.5 0 19 19" xmlns="http://www.w3.org/2000/svg"
                         class="cf-icon-svg">
                        <path
                              d="M.789 4.836a1.03 1.03 0 0 1 1.03-1.029h10.363a1.03 1.03 0 1 1 0 2.059H1.818A1.03 1.03 0 0 1 .79 4.836zm12.422 4.347a1.03 1.03 0 0 1-1.03 1.029H1.819a1.03 1.03 0 0 1 0-2.059h10.364a1.03 1.03 0 0 1 1.029 1.03zm0 4.345a1.03 1.03 0 0 1-1.03 1.03H1.819a1.03 1.03 0 1 1 0-2.059h10.364a1.03 1.03 0 0 1 1.029 1.03z" />
                    </svg>
                </button>

                <button class="hidden cursor-pointer text-xl fill-secondary-500 leading-none px-3 py-1 w-12 border border-solid border-transparent rounded bg-transparent block xl:hidden outline-none focus:outline-none"
                        type="button" id="closeNavbar">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 384 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path
                              d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                    </svg>
                </button>
            </div>
            <div class="xl:flex  items-center bg-white xl:bg-transparent xl:shadow-none hidden">
                <x-navigation />
            </div>
            <div class="xl:flex items-center flex-col justify-end bg-white xl:bg-transparent xl:shadow-none hidden">
                <a href="{{ Route::currentRouteName() === 'home' ? '#contact' : route('home') . '/#contact' }}"
                   class="bg-secondary-500 text-gray-600 active:bg-secondary-900 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 transition-all duration-300"
                   type="submit" style="transition: all 0.15s ease 0s;">
                    Prendre rendez-vous
                </a>
            </div>
        </div>
    </nav>
    <header class="relative py-16 flex flex-col items-center justify-center" style="min-height: 90vh;" id="home">
        <div class="absolute top-0 w-full h-full bg-cover bg-center bg-fixed"
             style="background-image: url(@if (isset($image)) {{ asset('storage/' . $image) }} @else {{ asset('images/DSC_0593.jpg') }} @endif)">
            <span id=" blackOverlay"
                  class="w-full h-full absolute opacity-50 bg-gradient-to-b backdrop-blur-sm to-primary-900 from-black"></span>
        </div>

        <div id="collapse-navbar" aria-expanded="false"
             class="aria-expanded:translate-x-0 transition-all right-0 duration-300 translate-x-full z-50 mt-20 w-full h-full fixed inset-0 bg-primary-900">
            <x-navigation></x-navigation>
        </div>

        <div class="container relative mx-auto -mt-16 h-full flex-1 flex flex-col justify-evenly items-center py-16">
            <div class="items-center w-full flex flex-wrap">
                <div class="w-full 2xl:w-10/12 lg:w-6/12 mx-auto">
                    <div class="flex flex-col items-center gap-2">
                        {{ $mainTitle }}
                    </div>
                </div>
            </div>

            <div class="flex md:hidden items-center justify-end bg-transparent shadow-none ">
                <a href="{{ route('home') }}/#contact"
                   class="bg-secondary-500 text-gray-600 active:bg-primary-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 transition-all duration-300"
                   type="submit" style="transition: all 0.15s ease 0s;">
                    Prendre rendez-vous
                </a>
            </div>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <x-footer></x-footer>
</body>

</html>
