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

    <main class="pb-20">
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