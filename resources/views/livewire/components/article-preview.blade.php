<div
     class="relative bg-white cursor-default flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg gs_reveal">
    <img src="{{ url('storage/' . $article->image) }}" class="w-full h-52 object-cover align-middle rounded-t-lg" />

    <div class="h-full flex flex-col p-2">
        <div class="flex-1">
            <h2 class="text-xl font-semibold">{{ $article->title }}</h2>
            <small>Publié le {{ $article->published_at->format('d/m/y') }}</small>
        </div>

        <livewire:components.tags :tags="$article->tags"></livewire:components.tags>

        <!-- <article class="prose-sm whitespace-pre-wrap max-h-52 max-w-12 truncate *:text-ellipsis overflow-hidden">{!! $article->content !!}</article> -->
        <div class="flex justify-end mt-8">
            <a href="{{ route('article', ['article' => $article]) }}"
               class="hover:bg-secondary-500/50 text-secondary-900 text-sm font-bold uppercase px-3 py-1 outline-none focus:outline-none mr-1 mb-1"
               type="submit" style="transition: all 0.15s ease 0s;">
                <div class="flex gap-2 items-center">
                    Lire l'article
                </div>
            </a>
        </div>
    </div>
</div>
