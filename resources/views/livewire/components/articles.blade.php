<div>
    <div class="pinned-articles mt-4">
        <span class="text-xl">A l'affiche</span>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 items-stretch gap-8 py-8">

            @foreach ($pinnedArticles as $pinnedArticle)
                <livewire:components.article-preview wire:key="pinned-{{ $pinnedArticle->id }}"
                                                     :article="$pinnedArticle"></livewire:components.article-preview>
            @endforeach
        </div>
    </div>

    
    <x-dropdown width="auto">
        <x-slot name="trigger">
            <div class="p-2  max-w-sm">
                <label class="filament-forms-field-wrapper-label">
                    <span class="text-sm font-medium block leading-4 text-primary-500">
                        Thème
                    </span>

                    <x-input type="text" class="text-sm " placeholder="Selectionner un thème" readonly></x-input>
                </label>

            </div>
        </x-slot>

        <x-slot name="content">
            <div class="rounded-md p-2 bg-white">

                @foreach ($tags as $key => $tag)
                    <div class="px-2 font-bold text-gray-600">
                        <label class="filament-forms-field-wrapper-label inline-flex items-center space-x-3">
                            <x-checkbox type="checkbox" wire:model.live="filters.tags"
                                        value="{{ $tag->id }}"></x-checkbox>
                            <span class="text-sm font-medium leading-4 text-primary-500">
                                {{ ucfirst($tag->name) }}
                            </span>
                        </label>
                    </div>
                @endforeach
            </div>
        </x-slot>
    </x-dropdown>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 items-stretch gap-8 py-8">
        @foreach ($articles as $article)
            <livewire:components.article-preview wire:key="{{ $article->id }}"
                                                 :article="$article"></livewire:components.article-preview>
        @endforeach
    </div>

    @if ($empty_new_articles)
        <div class="h-12 text-xl"><small>Il n'y a plus d'articles à afficher</small></div>
    @else
        <div id="scrollLoadingArticles" class="flex w-full justify-center items-center h-48">
            <div wire:loading class="h-16 w-16">
                <div role="status">
                    <svg aria-hidden="true" class="text-primary-500/25 animate-spin fill-primary-900"
                         viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                              fill="currentColor" />
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                              fill="currentFill" />
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    @endif
</div>

@script
    <script>
        window.addEventListener('scroll', function() {
            if (@this.empty_new_articles) return;

            let targetElement = document.getElementById('scrollLoadingArticles');
            let bounding = targetElement.getBoundingClientRect();

            if (bounding.top >= 0 && bounding.bottom <= window.innerHeight) {
                @this.call("getNextArticles")
            }
        });
    </script>
@endscript
