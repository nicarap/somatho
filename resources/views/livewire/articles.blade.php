<div class="container mx-auto my-16 px-4">
    <div class="flex flex-wrap justify-center text-center mb-24">
        <div class="w-full lg:w-6/12 px-4">
            <h2 class="text-4xl font-semibold">Articles</h2>
            <p class="text-lg leading-relaxed mt-4 mb-4 text-gray-500">
                Les derniers artciles publiés
            </p>
            <a href="{{ route('article.viewAny') }}" class="text-lg leading-relaxed mt-4 mb-4 text-gray-500">
                Voir tous les articles
            </a>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 items-start gap-8">
        @foreach($articles as $article)
        <div class="relative bg-white cursor-default flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg">
            <img src="{{ url('storage/'.$article->image) }}" class="w-full h-52 object-cover align-middle rounded-t-lg" />

            <div class="p-2">
                <h2 class="text-xl font-semibold mb-4">{{ $article->title }}</h2>
                <!-- <article class="prose-sm whitespace-pre-wrap max-h-52 max-w-12 truncate *:text-ellipsis overflow-hidden">{!! $article->content !!}</article> -->
                <div class="flex justify-end mt-8">
                    <a href="{{ route('article.view', ['article' => $article]) }}" class="hover:bg-secondary-200 text-secondary-600 text-sm font-bold uppercase px-3 py-1 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1" type="submit" style="transition: all 0.15s ease 0s;">
                        <div class="flex gap-2 items-center">
                            Lire l'article
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @endforeach


    </div>
</div>