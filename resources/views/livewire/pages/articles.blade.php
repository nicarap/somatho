<div>
    <x-slot:main-title>
        <h1 class="text-7xl font-serif font-light leading-relaxed mt-4 mb-4 text-secondary-500">
            Mes articles
        </h1>
    </x-slot:main-title>
    <section>
        <div class="bg-gradient-to-b from-primary-200 from-50% to-white">
            <div class="container mx-auto py-12 px-4">
                
            <div class="flex flex-wrap justify-center text-center">
                <div class="w-full max-w-7xl px-4">
                    <h2 class="text-4xl font-semibold uppercase text-primary-400">Articles</h2>
                    <p class="text-lg leading-relaxed mt-4 mb-4 text-gray-500">
                        Explorez l'ensemble des publications dédiées à la somatopathie. 
                        Plongez au cœur de cette thérapie douce, découvrez des conseils précieux pour améliorer votre bien-être physique et émotionnel.
                    </p>
                </div>
            </div>
            
                <livewire:components.articles :articles="App\Models\Article::published()->orderBy('published_at')->get()" />
            </div>
        </div>
    </section>
</div>
