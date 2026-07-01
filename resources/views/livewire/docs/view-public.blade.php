<div class="flex-1 flex flex-col min-w-0 bg-white">
    @if($doc && $currentPage)
        <div class="px-4 md:px-8 py-4 md:py-6 border-b border-gray-100">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $currentPage->title }}</h1>
        </div>

        <div class="px-4 md:px-8 py-3 md:py-4 border-b border-gray-100 overflow-x-auto">
            <div class="flex items-center gap-0.5 min-w-max">
                <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-400 cursor-not-allowed" title="Heading 1" disabled>
                    <x-icon name="heading-1" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                </button>
                <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-400 cursor-not-allowed" title="Heading 2" disabled>
                    <x-icon name="heading-2" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                </button>
                <div class="w-px h-4 md:h-5 bg-gray-200 mx-0.5 md:mx-1"></div>
                <span class="text-[11px] md:text-[13px] text-gray-500">Read-only view</span>
            </div>
        </div>

        <div class="flex-1 overflow-y-auto px-4 md:px-8 py-4 md:py-8">
            <article class="prose prose-gray max-w-none text-[13px] md:text-[15px]">
                {!! $currentPage->content ?? '<p class="text-gray-500">No content available for this page.</p>' !!}
            </article>
        </div>
    @else
        <div class="flex-1 flex items-center justify-center">
            <div class="text-center">
                <x-icon name="document-text" class="w-12 h-12 text-gray-300 mx-auto mb-4" />
                <h2 class="text-xl font-semibold text-gray-900 mb-2">Documentation not found</h2>
                <p class="text-gray-500">The requested documentation is not available or is private.</p>
            </div>
        </div>
    @endif
</div>