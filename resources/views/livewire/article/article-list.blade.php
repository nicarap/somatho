<div class="bg-gradient-to-b from-primary-200 from-50% to-white">
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
                        <a class="text-primary-800 hover:text-primary-400 hover:underline duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" href="{{ route('home') }}/#somatopathy">
                            <span class="inline-block ml-2">Somatopathie</span>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <a class="text-primary-800 hover:text-primary-400 hover:underline px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" href="{{ route('home') }}/#reasons">
                            <span class="inline-block ml-2">Pour qui ?</span>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <a class="text-primary-800 hover:text-primary-400 hover:underline px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" href="{{ route('home') }}/#contact">
                            <span class="inline-block ml-2">Contact</span>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <a class="text-primary-400 underline px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" href="#">
                            <span class="inline-block ml-2">Articles</span>
                        </a>
                    </li>
                </ul>
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
            <div class="w-full max-w-7xl mx-auto px-4">
                <h2 class="text-xl font-semibold text-center text-primary-400">Je vous partages plusieurs articles sur la somatopathie tiré de mes connaissances, mon experience.</h2>
            </div>
            <livewire:articles :articles="App\Models\Article::published()->orderBy('published_at')->get()" />
        </div>
    </div>
</div>