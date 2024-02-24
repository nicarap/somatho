<ul class="flex flex-col xl:flex-row gap-2 list-none xl:mx-auto">
    <li class="flex items-center">
        <a class="hover:text-secondary-500 {{ Route::currentRouteName() === 'home' ? 'text-secondary-500' : 'text-white' }} hover:underline duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold"
           href="{{ \Request::route()->getName() === 'home' ? '#home' : route('home') }}">
            <span class="inline-block ml-2">Accueil</span>
        </a>
    </li>
    <li class="flex items-center">
        <a class="hover:text-secondary-500 {{ Route::currentRouteName() === 'somatopathy' ? 'text-secondary-500' : 'text-white' }} hover:underline duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold"
           href="{{ route('somatopathy') }}">
            <span class="inline-block ml-2">Somatopathie</span>
        </a>
    </li>
    <li class="flex items-center">
        <a class="hover:text-secondary-500 {{ Route::currentRouteName() === 'traitment' ? 'text-secondary-500' : 'text-white' }} hover:underline duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold"
           href="{{ route('traitment') }}">
            <span class="inline-block ml-2">Consultation</span>
        </a>
    </li>
    @if (App\Models\Article::count() > 0)
        <li class="flex items-center">
            <a class="hover:text-secondary-500 {{ str_contains(Route::currentRouteName(), 'article') ? 'text-secondary-500' : 'text-white' }} hover:underline duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold"
               href="{{ route('articles') }}">
                <span class="inline-block ml-2">Articles</span>
            </a>
        </li>
    @endif
</ul>
