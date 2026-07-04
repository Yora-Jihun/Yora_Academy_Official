@props(['doc', 'currentPage'])

<div class="w-[280px] bg-white border-r border-[#EAEAEA] flex flex-col h-full hidden lg:flex">
    <div class="px-4 py-4 border-b border-gray-100">
        <h3 class="text-[11px] md:text-[13px] font-semibold text-gray-500 uppercase tracking-wider">Table of Contents</h3>
    </div>

    <nav class="flex-1 overflow-y-auto py-1.5 md:py-2">
        <div class="px-3 md:px-4 space-y-0.5">
            @if($doc)
                @foreach($doc->sections as $section)
                    <div class="space-y-0.5 mt-1 md:mt-1.5">
                        <button type="button" wire:click="toggleSection({{ $section->id }})" data-context-type="section" data-context-id="{{ $section->id }}" class="flex items-center gap-2 px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-[14px] text-gray-800 rounded-none w-full text-left">
                            <x-icon name="{{ in_array($section->id, $collapsedSections ?? [], true) ? 'chevron-right' : 'chevron-down' }}" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-400" />
                            <x-icon name="folder-open" class="w-3.5 h-3.5 md:w-4 md:h-4 text-amber-500" />
                            <span>{{ $section->title }}</span>
                        </button>

                        @unless(in_array($section->id, $collapsedSections ?? [], true))
                        <div class="ml-4 md:ml-6 space-y-0.5">
                            @foreach($section->pages as $page)
                                <button
                                    type="button"
                                    wire:key="page-{{ $page->id }}"
                                    wire:click="selectPage({{ $page->id }})"
                                    data-context-type="page"
                                    data-context-id="{{ $page->id }}"
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
                                data-context-type="page"
                                data-context-id="{{ $page->id }}"
                                class="w-full flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none hover:bg-gray-50 cursor-pointer tree-item {{ $currentPage?->id === $page->id ? 'active' : '' }}">
                                <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                                <span>{{ $page->title }}</span>
                            </button>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="px-3 md:px-4 py-8 text-center text-gray-500">
                    <p class="text-[13px]">No documentation found.</p>
                </div>
            @endif
        </div>
    </nav>
</div>