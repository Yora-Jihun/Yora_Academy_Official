<div class="flex-1 flex flex-col min-w-0 bg-[#FAFAFB]">
    <div class="px-4 md:px-8 py-4 md:py-6 bg-white border-b border-gray-100">
        <h1 class="text-xl md:text-2xl font-bold text-gray-900 mb-4 md:mb-5">Explore Public Documentation</h1>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 md:gap-4">
            <div class="flex items-center gap-1.5 md:gap-2 flex-wrap">
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-white bg-[#5B5FEF] rounded-full">All Topics</button>
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition hidden sm:inline">Web</button>
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition hidden sm:inline">Backend</button>
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition hidden sm:inline">Frontend</button>
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition">AI</button>
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition hidden sm:inline">DevOps</button>
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition hidden sm:inline">API</button>
                <button class="px-2.5 md:px-4 py-1 md:py-1.5 text-[11px] md:text-[13px] font-medium text-gray-600 bg-gray-100 rounded-full hover:bg-gray-200 transition hidden sm:inline">Mobile</button>
            </div>

            <div class="flex items-center gap-1.5 md:gap-2">
                <div class="relative">
                    <select class="appearance-none text-[11px] md:text-[13px] text-gray-700 bg-gray-50 border border-gray-100 rounded-none px-2 md:px-3 py-1 md:py-1.5 focus:outline-none focus:border-[#5B5FEF] transition pr-8">
                        <option>Trending</option>
                        <option>Most Recent</option>
                        <option>Most Stars</option>
                    </select>
                    <x-icon name="chevron-down" class="w-3 h-3 md:w-3.5 md:h-3.5 text-gray-400 absolute right-2 md:right-3 top-1/2 -translate-y-1/2 pointer-events-none" />
                </div>
            </div>
        </div>
    </div>

    <div class="flex-1 overflow-y-auto px-4 md:px-8 py-4 md:py-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            @forelse($docs as $doc)
                <div class="bg-white border border-gray-100 rounded-none overflow-hidden hover:shadow-lg transition-shadow">
                    <div class="px-4 md:px-5 pt-4 md:pt-5 pb-3 md:pb-4">
                        <div class="flex items-center gap-1.5 md:gap-2 mb-2 md:mb-3">
                            <x-icon name="book-open" class="w-4 h-4 md:w-5 md:h-5 text-[#5B5FEF]" />
                            <span class="text-[10px] md:text-[12px] font-medium text-gray-500 uppercase tracking-wider">Documentation</span>
                        </div>
                        <h3 class="text-[14px] md:text-[16px] font-semibold text-gray-900 mb-1.5 md:mb-2">{{ $doc->title }}</h3>
                        @if($doc->description)
                            <p class="text-[11px] md:text-[13px] text-gray-600 line-clamp-2 mb-3 md:mb-4">{{ $doc->description }}</p>
                        @else
                            <p class="text-[11px] md:text-[13px] text-gray-600 line-clamp-2 mb-3 md:mb-4">No description available.</p>
                        @endif
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-1.5 md:gap-2">
                                <img src="https://placehold.co/24x24/5B5FEF/white?text={{ substr($doc->user->fullname ?? 'A', 0, 1) }}" class="w-5 h-5 md:w-6 md:h-6 rounded-full" alt="Author">
                                <span class="text-[10px] md:text-[12px] text-gray-500">{{ $doc->user->fullname ?? 'Unknown' }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="px-4 md:px-5 py-2 md:py-2.5 border-t border-gray-50">
                        <a href="{{ route('public.docs.show', $doc->slug) }}" wire:navigate class="text-[10px] md:text-[11px] text-[#5B5FEF] hover:underline">View Documentation →</a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <x-icon name="document-text" class="w-12 h-12 text-gray-300 mx-auto mb-4" />
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">No public documentation found</h3>
                    <p class="text-gray-500">Check back later for new public docs.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>