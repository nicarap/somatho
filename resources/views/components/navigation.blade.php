<ul class="flex flex-col lg:flex-row gap-2 list-none lg:mx-auto">
    <li class="flex items-center">
        <a class="hover:text-secondary-500 {{ Route::currentRouteName() === "home" ? "text-secondary-500" : "text-white" }} hover:underline duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" active="{{ \Request::route()->getName() == "home" }}" href="{{ \Request::route()->getName() === 'home' ? '#home' : route('home') }}">
            <span class="inline-block ml-2">Acceuil</span>
        </a>
    </li>
    <li class="flex items-center">
        <a class="hover:text-secondary-500 {{ Route::currentRouteName() === "about" ? "text-secondary-500" : "text-white" }} hover:underline duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" active="{{ \Request::route()->getName() == "about" }}" href="{{ route('about') }}">
            <span class="inline-block ml-2">A propos de moi</span>
        </a>
    </li>
    <li class="flex items-center">
        <a class="hover:text-secondary-500 {{ Route::currentRouteName() === "somatopathy" ? "text-secondary-500" : "text-white" }} hover:underline duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" active="{{ \Request::route()->getName() == "somatopathy" }}" href="{{ route('somatopathy') }}">
            <span class="inline-block ml-2">Somatopathie</span>
        </a>
    </li>
    <li class="flex items-center">
        <a class="hover:text-secondary-500 {{ Route::currentRouteName() === "" ? "text-secondary-500" : "text-white" }} hover:underline duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" active="{{ \Request::route()->getName() == "" }}" href="{{ \Request::route()->getName() === 'home' ? '#reasons' : route('home').'/#reasons' }}">
            <span class="inline-block ml-2">Informations</span>
        </a>
    </li>
    <li class="flex items-center">
        <a class="hover:text-secondary-500 {{ Route::currentRouteName() === "" ? "text-secondary-500" : "text-white" }} hover:underline duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" active="{{ \Request::route()->getName() == "" }}" href="{{ \Request::route()->getName() === 'home' ? '#contact' : route('home').'/#contact' }}">
            <span class="inline-block ml-2">Contact</span>
        </a>
    </li>
    <li class="flex items-center">
        <a class="hover:text-secondary-500 {{ Route::currentRouteName() === "articles" ? "text-secondary-500" : "text-white" }} hover:underline duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold" active="{{ \Request::route()->getName() == "articles" }}" href="{{ route('article.viewAny') }}">
            <span class="inline-block ml-2">Articles</span>
        </a>
    </li>
</ul>