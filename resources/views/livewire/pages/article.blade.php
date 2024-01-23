<div>
    <x-slot:main-title>
        <h1 class="text-7xl font-serif font-light leading-relaxed mt-4 mb-4 text-secondary-500">
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

            <div class="text-sm mt-4 bg-primary-500 p-4 w-7/12">

                <div class="flex w-full gap-4 items-stretch">
                    <img class="w-32" src="{{ asset('images/me.jpg') }}" alt="Photo de Amelie Bonzi" />
                    <div class="text-gray-100  text-justify flex flex-col justify-between">
                        <p class="text-xl italic">A propos de l'auteur : </p>
                        <p>
                            Ensemble, cultivons l'harmonie du corps et de l'esprit.
                            Forte de ma passion et de mon expertise en somatopathie, je vous guide à travers mes
                            soins, vous offrant une perspective unique sur le bien-être
                        </p>
                        <p>
                            Êtes-vous prêt à embarquer dans ce voyage transformateur à mes côtés ? Je suis
                            <a href="{{ route('about') }}" class="font-bold hover:underline text-secondary-500">Amélie
                                Bonzi</a>,
                            somatothérapeute engagée à rétablir votre équilibre physique et mental.
                        </p>
                    </div>
                </div>
            </div>

            {{-- <div class="mt-4 p-4 border bg-gray-100">
                <span>Laisser un commentaire :</span>
                <livewire:components.article.comment :article="$article"></livewire:components.article.comment>
                Commentaire
            </div> --}}
        </div>
    </section>
</div>
