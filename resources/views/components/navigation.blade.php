<div class="relative flex items-stretch h-full">
    <div>
        <ul class="flex flex-col xl:flex-row gap-2 list-none xl:mx-auto">
            <li class="flex items-center">
                <a class="hover:text-gray-200 {{ Route::currentRouteName() === 'home' ? 'text-gray-200' : 'text-primary-500' }} duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold"
                   href="{{ \Request::route()->getName() === 'home' ? '#home' : route('home') }}">
                    <span class="inline-block ml-2">Accueil</span>
                </a>
            </li>
            <li class="flex items-center">
                <a class="hover:text-gray-200 {{ Route::currentRouteName() === 'somatopathy' ? 'text-gray-200' : 'text-primary-500' }} duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold"
                   href="{{ route('somatopathy') }}">
                    <span class="inline-block ml-2">Somatopathie & Méthode Poyet</span>
                </a>
            </li>
            <li class="flex items-center">
                <a class="hover:text-gray-200 {{ Route::currentRouteName() === 'traitment' ? 'text-gray-200' : 'text-primary-500' }} duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold"
                   href="{{ route('traitment') }}">
                    <span class="inline-block ml-2">Consultation</span>
                </a>
            </li>
            @if (App\Models\Article::count() > 0)
                <li class="flex items-center">
                    <a class="hover:text-gray-200 {{ str_contains(Route::currentRouteName(), 'article') ? 'text-gray-200' : 'text-primary-500' }} duration-100 transition-all px-3 py-4 lg:py-2 flex items-center text-md uppercase font-bold"
                       href="{{ route('articles') }}">
                        <span class="inline-block ml-2">Articles</span>
                    </a>
                </li>
            @endif
        </ul>
    </div>
    <div class="hidden relative w-full h-full sm:flex xl:hidden items-center justify-center">
        <div class="relative w-80 h-80 opacity-50">
            <div class="z-10 absolute fill-primary-50 opacity-20 aspect-auto w-full -top-[60%]">
                @include('logo.masse')
            </div>
            <div class="z-20 fill-primary-500 aspect-auto">@include('logo.complete')</div>
        </div>
    </div>
</div>
