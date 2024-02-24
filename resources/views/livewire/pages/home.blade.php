<div>
    <x-slot:main-title>
        <div class="fill-secondary-500 aspect-auto w-[18rem] xl:w-[28rem]">@include('logo.name')</div>
        <div class="fill-secondary-500 my-4 w-[18rem] xl:w-[28rem]">@include('logo.slogan')</div>
    </x-slot:main-title>


    <section class="hidden md:block 2xl:pb-20 relative bg-primary-200">
        <div class="bottom-auto -top-[69px] left-0 right-0 w-full absolute pointer-events-none overflow-hidden"
             style="height: 70px;">
            <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
                 version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                <polygon class="text-primary-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
        <div class="container relative 2xl:h-16 mx-auto px-4">
            <div class="flex 2xl:absolute -top-64 flex-wrap">
                <div class="lg:pt-12 pt-6 w-full md:w-4/12 px-4 text-center">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                        <div class="px-4 py-5 flex-auto">
                            <div
                                 class="p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full border border-secondary-900 text-secondary-900 bg-secondary-50">
                                @svg('heroicon-m-squares-2x2')
                            </div>
                            <h6 class="text-xl font-semibold">Libérez votre bien-être avec la Somatopathie</h6>
                            <p class="mt-2 mb-8 text-gray-600">
                                Explorez les bienfaits de la Somatopathie,
                                une approche holistique qui harmonise le corps et les émotions pour restaurer votre
                                équilibre naturel
                            </p>
                            <a href="{{ route('somatopathy') }}"
                               class="bg-primary-900 text-white hover:bg-primary-500 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 transition-all duration-300">
                                Décourvrir la méthode poyet
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-4/12 px-4 text-center">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                        <div class="px-4 py-5 flex-auto">
                            <div
                                 class="p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full border border-secondary-900 text-secondary-900 bg-secondary-50">
                                @svg('heroicon-s-chat-bubble-left-ellipsis')
                            </div>
                            <h6 class="text-xl font-semibold">Personnalisation du soin, Inspirée par l'Ostéopathie</h6>
                            <p class="mt-2 mb-8 text-gray-600">
                                Profitez d'une approche de soin personnalisée qui s'appuie sur les principes de
                                l'ostéopathie tout en intégrant des techniques novatrices de Somatopathie.
                            </p>
                            <a href="#contact"
                               class="bg-primary-900 text-white hover:bg-primary-500 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 transition-all duration-300">
                                Prendre rendez-vous
                            </a>
                        </div>
                    </div>
                </div>
                <div class="pt-6 w-full md:w-4/12 px-4 text-center">
                    <div class="relative flex flex-col min-w-0 break-words bg-white w-full mb-8 shadow-lg rounded-lg">
                        <div class="px-4 py-5 flex-auto">
                            <div
                                 class="p-3 text-center inline-flex items-center justify-center w-12 h-12 mb-5 shadow-lg rounded-full border border-secondary-900 text-secondary-900 bg-secondary-50">
                                @svg('heroicon-s-shield-check')
                            </div>
                            <h6 class="text-xl font-semibold">Découvrez l'Expertise d'une Practicienne Passionnéee</h6>
                            <p class="mt-2 mb-8 text-gray-600">
                                Je suis Amelie Bonzi et je met à votre disposition une passion dédiée à l'amélioration
                                de votre bien-être grâce à la Somatopathie.
                            </p>
                            <a href="#about"
                               class="bg-primary-900 text-white hover:bg-primary-500 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 transition-all duration-300">
                                Plus d'information
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-20 bg-primary-200" id="about">
        <x-about></x-about>
    </section>
    <section class="min-h-screen flex justify-between flex-col" id="reasons">
        <div class="relative">
            <div class="custom-shape-divider-top-1703755415 -top-1 md:-top-3"
                 style="
                    position: absolute;
                    left: 0;
                    width: 100%;
                    overflow: hidden;
                    line-height: 0;
                    ">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120"
                     preserveAspectRatio="none" class="fill-primary-200">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"
                          opacity=".25" class="shape-fill"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z"
                          opacity=".5" class="shape-fill"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z"
                          class="shape-fill"></path>
                </svg>
            </div>
            <x-somatotherapy></x-somatotherapy>
        </div>
    </section>

    @if ($hasReviews)
        <section class="pt-20 pb-48">
            <livewire:reviews></livewire:reviews>
        </section>
    @endif

    <section class="relative block bg-primary-200">
        <div class="bottom-auto top-1 left-0 right-0 w-full absolute pointer-events-none overflow-hidden -mt-20"
             style="height: 80px;">
            <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"
                 version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                <polygon class="text-primary-200 fill-current" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
        <x-traitment></x-traitment>

        <div class="mx-auto my-8 sm:my-0 flex justify-center">
            <a href="{{ route('traitment') }}"
               class="bg-primary-900 text-gray-100 hover:bg-primary-500 active:bg-primary-500 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 transition-all duration-300">
                En savoir plus sur la consultation
            </a>
        </div>

        @if ($link = env('GOOGLE_MAP_LINK'))
            <div class="overflow-hidden py-8">
                <div class="relative h-80">
                    <div class="absolute h-full w-full inset-0 z-10">
                        <iframe src="{{ $link }}" width="100%" height="100%" style="border:0;"
                                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        @endif

        <div class="relative block pt-8 md:pb-20 lg:pt-16 bg-primary-200" id="contact">

            <div class="flex flex-wrap justify-center gap-16">
                <div class="w-full lg:w-6/12 md:px-4">
                    <livewire:contact></livewire:contact>
                </div>
            </div>
    </section>

    @if ($hasArticles)
        <section class="relative bg-gray-200 block pb-20 lg:pt-12" id="articles">
            <div class="container mx-auto py-12 px-4">
                <div class="flex flex-wrap justify-center text-center">
                    <div class="w-full max-w-7xl px-4">
                        <h2 class="text-4xl font-semibold text-primary-500">Articles</h2>
                        <p class="text-lg md:text-center text-justify leading-relaxed mt-4 mb-4 text-gray-500">
                            Explorez les toutes dernières publications dédiées à la somatopathie.
                            Plongez au cœur de cette thérapie douce, découvrez des conseils précieux pour améliorer
                            votre
                            bien-être physique et émotionnel.
                        </p>
                        <p class="text-xl font-semibold leading-relaxed mt-4 mb-4 text-gray-500">Bienvenue dans
                            l'univers de
                            la somatopathie !</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 items-stretch gap-8 py-8">
                    @foreach (App\Models\Article::published()->orderBy('published_at')->limit(4)->get() as $article)
                        <livewire:components.article-preview :article="$article"></livewire:components.article-preview>
                    @endforeach
                </div>

                <div class="text-center mt-8">
                    <a href="{{ route('articles') }}"
                       class="bg-primary-900 text-white hover:bg-primary-500 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 transition-all duration-300">
                        Découvrez tous les Articles
                    </a>
                </div>
            </div>
        </section>
    @endif
    <div class="relative">
        <div class="bottom-auto top-1 left-0 right-0 w-full absolute z-50 pointer-events-none overflow-hidden -mt-20"
             style="height: 80px;">
            <svg class="absolute bottom-0 overflow-hidden" xmlns="http://www.w3.org/2000/svg"
                 preserveAspectRatio="none" version="1.1" viewBox="0 0 2560 100" x="0" y="0">
                <polygon class="text-primary-900 fill-current" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
</div>

@script
    <script>
        window.axeptioSettings = {
            clientId: "65d98de24de9dba969c6ae44",
            cookiesVersion: "bonzi somato-fr-EU",
            googleConsentMode: {
                default: {
                    analytics_storage: "denied",
                    ad_storage: "denied",
                    ad_user_data: "denied",
                    ad_personalization: "denied",
                    wait_for_update: 500
                }
            }
        };

        (function(d, s) {
            var t = d.getElementsByTagName(s)[0],
                e = d.createElement(s);
            e.async = true;
            e.src = "//static.axept.io/sdk.js";
            t.parentNode.insertBefore(e, t);
        })(document, "script");
    </script>
@endscript
