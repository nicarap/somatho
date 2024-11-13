<div>
    <x-slot:main-title>
        <h1 class="text-3xl px-4 md:text-5xl font-serif font-light leading-relaxed mt-4 mb-4 text-primary-500">
            {{ $article->title }}
        </h1>
    </x-slot:main-title>
    <section class="pb-20 bg-primary-200" id="article">
        <div class="max-w-7xl mx-auto w-full py-16 px-4">
            <div class="bg-white shadow-md px-12 py-6 rounded-md">
                <article class="prose-sm text-justify whitespace-pre-wrap">
                    {!! $article->content !!}
                </article>

                <p class="text-gray-400 italic">Article mis à jour le {{ $article->updated_at->format('d/m/Y') }}</p>
                <livewire:components.tags :tags="$article->tags"></livewire:components.tags>
            </div>

            <div class="text-sm mt-4 w-7/12">

                <div class="flex w-full items-center">
                    <img class="w-32 rounded-md" src="{{ asset('images/amelie.jpg') }}" alt="Photo de Amelie Bonzi" />
                    <div class="text-gray-100 bg-primary-500 text-justify flex flex-col justify-between p-4 rounded-r-md">
                        <p class="pb-2 text-xl italic">A propos de l'auteur : </p>
                        <p class="pb-2">
                            Ensemble, cultivons l'harmonie du corps et de l'esprit.
                            Forte de ma passion et de mon expertise en somatopathie, je vous guide à travers mes
                            soins, vous offrant une perspective unique sur le bien-être
                        </p>
                        <p>
                            Êtes-vous prêt à embarquer dans ce voyage transformateur à mes côtés ? Je suis
                            <span class="font-bold hover:underline text-md text-gray-800">Amélie Bonzi</span>,
                            somatopathe investie à rétablir votre équilibre physique et émotionnel.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
