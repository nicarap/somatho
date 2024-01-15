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
                <a href="#contact" class="bg-secondary-500 text-white active:bg-primary-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="submit" style="transition: all 0.15s ease 0s;">
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
                            <div class="fill-secondary-50 aspect-auto" style="width:400px">@include('logo.name')</div>
                            <div class="fill-secondary-50 my-4" style="width:500px">@include('logo.slogan')</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="top-auto bottom-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden" style="height: 70px;">
            <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                <polygon class="text-primary-500 fill-current" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </header>
    <section class="pb-20 bg-primary-500">
        <div class="container mx-auto px-4 -mt-24">
            <div class="flex flex-wrap">
                <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                        <div class="px-4 py-5 flex-auto">
                            <div class="p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full text-secondary-500 bg-secondary-50/50">
                                @svg('heroicon-m-squares-2x2')
                            </div>
                            <h6 class="text-xl font-semibold">Libérez votre bien-être avec la Somatopathie</h6>
                            <p class="mt-2 mb-4 text-gray-600">
                                Explorez les bienfaits de la somatopathie, 
                                une approche holistique qui harmonise le corps et les émotions pour restaurer votre équilibre naturel
                            </p>
                            <a href="{{ route('somatopathy') }}" class="bg-primary-900 text-white hover:bg-primary-500 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 transition-all duration-300">
                                Décourvrir la méthode poyet
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-4/12 px-4 text-center">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                        <div class="px-4 py-5 flex-auto">
                            <div class="p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full text-secondary-500 bg-secondary-50/50">
                                @svg('heroicon-s-chat-bubble-left-ellipsis')
                            </div>
                            <h6 class="text-xl font-semibold">Personnalisation du soin, Inspirée par l'Ostéopathie</h6>
                            <p class="mt-2 mb-4 text-gray-600">
                                Profitez d'une approche de soin personnalisée qui s'appuie sur les principes de l'ostéopathie tout en intégrant des techniques novatrices de somatopathie.
                            </p>
                            <a href="#contact" class="bg-primary-900 text-white hover:bg-primary-500 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 transition-all duration-300">
                                Prendre rendez-vous
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pt-6 w-full md:w-4/12 px-4 text-center">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                        <div class="px-4 py-5 flex-auto">
                            <div class="p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full text-secondary-500 bg-secondary-50/50">
                                @svg('heroicon-s-shield-check')
                            </div>
                            <h6 class="text-xl font-semibold">Découvrez l'Expertise d'une Practicienne Passionnéee</h6>
                            <p class="mt-2 mb-4 text-gray-600">
                                Amelie Bonzi, forte de son expérience professionnelle, met à votre disposition une passion dédiée à l'amélioration de votre bien-être grâce à la somatopathie.
                            </p>
                            <a href="{{ route('about') }}" class="bg-primary-900 text-white hover:bg-primary-500 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 transition-all duration-300">
                                Plus d'informations
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-20 bg-primary-500" id="about">
        <x-about></x-about>
    </section>
    <section class="min-h-screen flex justify-between flex-col" id="reasons">
        <div class="relative">
            <div class="custom-shape-divider-top-1703755415" style="
                    position: absolute;
                    top: -1rem;
                    left: 0;
                    width: 100%;
                    overflow: hidden;
                    line-height: 0;
                    transform: rotate(-1deg);
                    ">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" class="fill-primary-500">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
                </svg>
            </div>
            <x-somatotherapy></x-somatotherapy>
        </div>
        
        <div class="max-w-7xl mx-auto">
            <small>*: Il est toujours recommandé de consulter un professionnel de la santé qualifié pour discuter de toute condition médicale ou problème de santé. La somatopathie peut être complémentaire, mais ne remplace pas les soins médicaux traditionnels.</p>
        </div>
    </section>

    <section class="pt-20 pb-48">
        <livewire:reviews></livewire:reviews>
    </section>
    
    <section class="relative block bg-primary-200">
        <div class="bottom-auto top-0 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20" style="height: 80px;">
            <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                <polygon class="text-primary-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
        <x-traitment></x-traitment>
        
    <div class="relative block pb-20 lg:pt-20 bg-primary-200" id="contact">
            <livewire:contact></livewire:contact>
    </div>
</section>
    

    <section class="relative block pb-20 lg:pt-12" id="articles">
        <div class="container mx-auto my-12 px-4">
        <div class="flex flex-wrap justify-center text-center">
            <div class="w-full max-w-7xl px-4">
                <h2 class="text-4xl font-semibold uppercase text-primary-500">Articles</h2>
                <p class="text-lg leading-relaxed mt-4 mb-4 text-gray-500">
                    Explorez les toutes dernières publications dédiées à la somatopathie. 
                    Plongez au cœur de cette thérapie douce, découvrez des conseils précieux pour améliorer votre bien-être physique et émotionnel.
                </p>
                <p class="text-xl font-semibold leading-relaxed mt-4 mb-4 text-gray-500">Bienvenue dans l'univers de la somatopathie !</p>
            </div>
        </div>

        <livewire:articles :articles="App\Models\Article::published()->orderBy('published_at')->limit(4)->get()" />


        <div class="text-center">
            <a href="{{ route('article.viewAny') }}" class="bg-secondary-500 text-white active:bg-secondary-700 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="submit" style="transition: all 0.15s ease 0s;">
                <div class="flex gap-2 items-center">
                    Découvrez tous les articles
                </div>
            </a>
        </div>
        </div>
    </section>

    <x-footer></x-footer>
</body>
</html>