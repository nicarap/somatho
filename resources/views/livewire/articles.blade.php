<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 items-start gap-8 py-8">
    @foreach($articles as $article)
    <div class="relative bg-white cursor-default flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg gs_reveal">
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