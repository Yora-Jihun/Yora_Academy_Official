<div class="flex h-screen">
    <aside class="w-[280px] fixed left-0 top-0 h-screen bg-white border-r border-[#EAEAEA] flex flex-col z-50 transition-all duration-300 hidden md:flex">
        <div class="px-4 pt-6 pb-4 flex items-center justify-between">
            <a href="{{ route('welcome') }}" wire:navigate class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#5B5FEF] rounded-none flex items-center justify-center shadow-sm">
                    <x-icon name="book-open" class="w-5 h-5 text-white" />
                </div>
                <span class="text-[17px] font-semibold text-gray-900">Yora Academy</span>
            </a>
        </div>

        @if($doc)
        <nav class="flex-1 px-3 space-y-0.5 overflow-y-auto">
            <div class="px-3 py-2">
                <h3 class="text-xs font-semibold text-gray-900">{{ $doc->title }}</h3>
                @if($doc->description)
                <p class="text-[11px] text-gray-500 mt-1">{{ $doc->description }}</p>
                @endif
            </div>
        </nav>
        @endif

        <div class="px-3 py-4 space-y-0.5">
            @guest
            <a href="{{ route('login') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 text-[14px] text-gray-600 rounded-none hover:bg-[#F5F6FF] hover:text-[#5B5FEF] transition">
                <x-icon name="document-text" class="w-5 h-5" />
                <span>My Documentation</span>
            </a>
            @else
            <a href="{{ route('welcome') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 text-[14px] text-gray-600 rounded-none hover:bg-[#F5F6FF] hover:text-[#5B5FEF] transition">
                <x-icon name="home" class="w-5 h-5" />
                <span>Home</span>
            </a>
            @endguest
        </div>
    </aside>

    <div class="flex-1 flex flex-col min-w-0 md:ml-[280px]">
        <div class="sticky top-0 z-30 h-14 md:h-[72px] bg-white border-b border-gray-100 flex items-center justify-between px-4 md:px-6">
            <div class="flex items-center gap-2 md:gap-4">
                <div class="relative">
                    <x-icon name="search" class="w-3.5 h-3.5 md:w-5 md:h-5 text-gray-400 absolute left-2.5 md:left-3.5 top-1/2 -translate-y-1/2" />
                    <input type="text" placeholder="Search..." class="w-48 sm:w-56 md:w-80 pl-8 md:pl-10 pr-2 md:pr-4 py-1.5 md:py-2.5 text-xs md:text-[14px] text-gray-600 bg-gray-50 border border-gray-100 rounded-none focus:outline-none focus:border-[#5B5FEF] focus:bg-white transition">
                </div>
            </div>

            <div class="flex items-center gap-1.5 md:gap-3">
                @guest
                <a href="{{ route('login') }}" wire:navigate class="px-2.5 md:px-4 py-1 md:py-1.5 md:py-2.5 text-xs md:text-[14px] font-medium text-gray-600 bg-gray-50 rounded-none hover:bg-gray-100 transition">
                    Sign In
                </a>
                <a href="{{ route('register') }}" wire:navigate class="px-2.5 md:px-4 py-1 md:py-1.5 md:py-2.5 text-xs md:text-[14px] font-medium text-white bg-[#5B5FEF] rounded-none hover:bg-[#4A4DDF] transition">
                    Sign Up
                </a>
                @endguest

                <button type="button" aria-label="Toggle theme" class="p-1.5 md:p-2.5 rounded-none bg-gray-50 hover:bg-gray-100 transition">
                    <x-icon name="theme" class="w-3.5 h-3.5 md:w-5 md:h-5 text-gray-600" />
                </button>
            </div>
        </div>

        @if($doc)
        <div class="flex flex-1 min-h-0">
            <div class="w-[280px] bg-white border-r border-[#EAEAEA] flex flex-col h-full hidden lg:flex">
                <div class="px-4 py-4 border-b border-gray-100">
                    <h3 class="text-[11px] md:text-[13px] font-semibold text-gray-500 uppercase tracking-wider">Table of Contents</h3>
                </div>

                <nav class="flex-1 overflow-y-auto py-1.5 md:py-2">
                    <div class="px-3 md:px-4 space-y-0.5">
                        @foreach($doc->sections as $section)
                        <div class="space-y-0.5 mt-1 md:mt-1.5" wire:key="section-{{ $section->id }}">
                            <button type="button" wire:click="toggleSection({{ $section->id }})" class="flex items-center gap-2 px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-[14px] text-gray-800 rounded-none w-full text-left">
                                <x-icon name="{{ in_array($section->id, $collapsedSections, true) ? 'chevron-right' : 'chevron-down' }}" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-400" />
                                <x-icon name="folder-open" class="w-3.5 h-3.5 md:w-4 md:h-4 text-amber-500" />
                                <span>{{ $section->title }}</span>
                            </button>

                            @unless(in_array($section->id, $collapsedSections, true))
                            <div class="ml-4 md:ml-6 space-y-0.5" wire:key="section-pages-{{ $section->id }}">
                                @foreach($section->pages as $page)
                                <button
                                    type="button"
                                    wire:key="page-{{ $page->id }}"
                                    wire:click="selectPage({{ $page->id }})"
                                    class="w-full flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none hover:bg-gray-50 cursor-pointer tree-item {{ $currentPage?->id === $page->id ? 'active' : '' }}">
                                    <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                                    <span>{{ $page->title }}</span>
                                </button>
                                @endforeach
                            </div>
                            @endunless
                        </div>
                        @endforeach

                        @if($doc->pages->where('section_id', null)->isNotEmpty())
                        <div class="space-y-0.5 mt-1 md:mt-1.5">
                            @foreach($doc->pages->where('section_id', null) as $page)
                            <button
                                type="button"
                                wire:key="page-{{ $page->id }}"
                                wire:click="selectPage({{ $page->id }})"
                                class="w-full flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none hover:bg-gray-50 cursor-pointer tree-item {{ $currentPage?->id === $page->id ? 'active' : '' }}">
                                <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                                <span>{{ $page->title }}</span>
                            </button>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </nav>
            </div>

            <div class="flex-1 flex flex-col min-w-0">
                @if($currentPage)
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
                        <h2 class="text-xl font-semibold text-gray-900 mb-2">Page not found</h2>
                        <p class="text-gray-500">The requested page is not available.</p>
                    </div>
                </div>
                @endif
            </div>

            <div class="w-[280px] bg-white border-l border-[#EAEAEA] flex flex-col h-full hidden xl:flex">
                <div class="px-3 md:px-4 py-3 md:py-4 border-b border-gray-100">
                    <h3 class="text-[11px] md:text-[13px] font-semibold text-gray-900 uppercase tracking-wider mb-2 md:mb-3">Page Outline</h3>
                    <div class="space-y-0.5 max-h-48 overflow-y-auto">
                        @if($currentPage && $currentPage->content)
                        @php
                        $outlineItems = [];
                        if (preg_match_all('/<h[23][^>]*>(.*?)<\/h[23]>/s', $currentPage->content, $matches)) {
                        foreach ($matches[0] as $i => $match) {
                        $level = (int) substr($matches[0][$i], 2, 1);
                        $text = strip_tags($matches[1][$i]);
                        $outlineItems[] = ['level' => $level, 'text' => $text];
                        }
                        }
                        @endphp
                        @foreach($outlineItems as $item)
                        <a href="#" class="block text-[11px] md:text-[13px] text-gray-600 hover:text-[#5B5FEF] py-0.5 md:py-1 px-{{ $item['level'] === 2 ? '1.5' : '3' }} md:px-{{ $item['level'] === 2 ? '2' : '3' }} rounded-none transition">
                            {{ $item['text'] }}
                        </a>
                        @endforeach
                        @else
                        <p class="text-[11px] md:text-[13px] text-gray-500">No outline available</p>
                        @endif
                    </div>
                </div>

                <div class="px-3 md:px-4 py-3 md:py-4 space-y-3 md:space-y-4">
                    <div>
                        <span class="text-[10px] md:text-[11px] text-gray-500 uppercase tracking-wider">Status</span>
                        <div class="mt-0.5 md:mt-1">
                            <span class="inline-flex items-center px-2 md:px-2.5 py-0.5 md:py-1 text-[11px] md:text-[12px] font-medium bg-green-100 text-green-700 rounded-full">Published</span>
                        </div>
                    </div>

                    <div>
                        <span class="text-[10px] md:text-[11px] text-gray-500 uppercase tracking-wider">Visibility</span>
                        <div class="mt-0.5 md:mt-1">
                            <span class="inline-flex items-center px-2 md:px-2.5 py-0.5 md:py-1 text-[11px] md:text-[12px] font-medium bg-[#F5F6FF] text-[#5B5FEF] rounded-full">Public</span>
                        </div>
                    </div>

                    @if($doc && $doc->user)
                    <div class="flex items-center gap-2 md:gap-3">
                        <img src="https://placehold.co/32x32/5B5FEF/white?text={{ substr($doc->user->fullname ?? 'A', 0, 1) }}" class="w-7 h-7 md:w-8 md:h-8 rounded-full" alt="Author">
                        <div>
                            <p class="text-[11px] md:text-[13px] font-medium text-gray-900">{{ $doc->user->fullname ?? 'Author' }}</p>
                            <p class="text-[10px] md:text-[11px] text-gray-500">Maintainer</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
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
</div>