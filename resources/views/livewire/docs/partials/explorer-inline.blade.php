<div x-data="{ inlineAddPageSectionId: null, showInlineSectionInput: false }" x-cloak class="w-[280px] bg-white border-r border-[#EAEAEA] flex flex-col h-full hidden lg:flex">
    <div class="px-4 py-4 border-b border-gray-100 flex items-center justify-between">
        <h3 class="text-[11px] md:text-[13px] font-semibold text-gray-500 uppercase tracking-wider">Table of Contents</h3>
        <div class="flex items-center gap-1">
            <button type="button" @click="showInlineSectionInput = true; setTimeout(() => { document.querySelector('[data-section-input]').focus() }, 10)" class="p-1 rounded-none hover:bg-gray-50 text-gray-600" title="Add Section">
                <x-icon name="folder-plus" class="w-4 h-4" />
            </button>
            <button type="button" @click="inlineAddPageSectionId = null; setTimeout(() => { document.querySelector('[data-page-input]').focus() }, 10)" class="p-1 rounded-none hover:bg-gray-50 text-gray-600" title="Add Page">
                <x-icon name="document-plus" class="w-4 h-4" />
            </button>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto py-1.5 md:py-2">
        <div class="px-3 md:px-4 space-y-0.5">
            @if(!$doc)
                <div class="px-3 md:px-4 py-8 text-center text-gray-500">
                    <p class="text-[13px]">No documentation found.</p>
                </div>
            @else
                @foreach($doc->sections as $section)
                    <div class="space-y-0.5 mt-1 md:mt-1.5">
                        @if($editingSectionId === $section->id)
                        <div class="flex items-center gap-2 px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-[14px] text-gray-800 rounded-none">
                            <x-icon name="folder-open" class="w-3.5 h-3.5 md:w-4 md:h-4 text-amber-500" />
                            <input id="rename-section-{{ $section->id }}" type="text" wire:model.defer="editingTitle" wire:keydown.enter="saveRename" wire:keydown.escape="cancelRename" wire:blur="saveRename" class="flex-1 px-1 text-xs md:text-[14px] border border-[#5B5FEF] rounded-none focus:outline-none" placeholder="Rename section..." />
                        </div>
                        @else
                        <div class="flex items-center gap-2 px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-[14px] text-gray-800 rounded-none group" data-context-type="section" data-context-id="{{ $section->id }}">
                            <button type="button" wire:click="toggleSection({{ $section->id }})" class="flex items-center gap-2 flex-1 text-left">
                                <x-icon name="{{ in_array($section->id, $collapsedSections ?? [], true) ? 'chevron-right' : 'chevron-down' }}" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-400" />
                                <x-icon name="folder-open" class="w-3.5 h-3.5 md:w-4 md:h-4 text-amber-500" />
                                <span class="flex-1 truncate text-left">{{ $section->title }}</span>
                            </button>
                            <button type="button" @click="inlineAddPageSectionId = {{ $section->id }}; setTimeout(() => { document.querySelector('[data-page-input=' + {{ $section->id }} + ']').focus() }, 10)" class="p-1 rounded-none hover:bg-gray-50 text-gray-600 opacity-0 group-hover:opacity-100 transition focus:opacity-100" title="Add Page to Section">
                                <x-icon name="document-plus" class="w-3.5 h-3.5" />
                            </button>
                        </div>
                        @endif

                        @unless(in_array($section->id, $collapsedSections ?? []))
                        <div class="ml-4 md:ml-6 space-y-0.5">
                            @foreach($section->pages as $page)
                                @if($editingPageId === $page->id)
                                <div class="flex items-center gap-2 px-2 md:px-3 py-1">
                                    <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                                    <input id="rename-page-{{ $page->id }}" type="text" wire:model.defer="editingTitle" wire:keydown.enter="saveRename" wire:keydown.escape="cancelRename" wire:blur="saveRename" class="flex-1 px-1 text-xs md:text-[14px] border border-[#5B5FEF] rounded-none focus:outline-none" placeholder="Rename page..." />
                                </div>
                                @else
                                <button
                                    type="button"
                                    wire:key="page-{{ $page->id }}"
                                    wire:click="selectPage({{ $page->id }})"
                                    data-context-type="page"
                                    data-context-id="{{ $page->id }}"
                                    class="w-full flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none hover:bg-gray-50 cursor-pointer tree-item {{ $currentPage?->id === $page->id ? 'active' : '' }}">
                                    <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                                    <span class="flex-1 truncate text-left">{{ $page->title }}</span>
                                </button>
                                @endif
                            @endforeach

                            <div x-show="inlineAddPageSectionId == {{ $section->id }}" class="flex items-center gap-2 px-2 md:px-3 py-1">
                                <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                                <input type="text" data-page-input="{{ $section->id }}" wire:model="inlinePageTitle" @keydown.enter="$wire.createPageInline({{ $section->id }}); inlineAddPageSectionId = null" @keydown.escape="inlineAddPageSectionId = null" @blur="$wire.createPageInline({{ $section->id }})" class="flex-1 px-1 text-xs md:text-[14px] border border-[#5B5FEF] rounded-none focus:outline-none" placeholder="New page title..." />
                            </div>
                        </div>
                        @endunless
                    </div>
                @endforeach

                @if($doc->pages->where('section_id', null)->isNotEmpty())
                <div class="space-y-0.5 mt-1 md:mt-1.5">
                    @foreach($doc->pages->where('section_id', null) as $page)
                        @if($editingPageId === $page->id)
                        <div class="flex items-center gap-2 px-2 md:px-3 py-1">
                            <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                            <input id="rename-page-{{ $page->id }}" type="text" wire:model.defer="editingTitle" wire:keydown.enter="saveRename" wire:keydown.escape="cancelRename" wire:blur="saveRename" class="flex-1 px-1 text-xs md:text-[14px] border border-[#5B5FEF] rounded-none focus:outline-none" placeholder="Rename page..." />
                        </div>
                        @else
                        <button
                            type="button"
                            wire:key="page-{{ $page->id }}"
                            wire:click="selectPage({{ $page->id }})"
                            data-context-type="page"
                            data-context-id="{{ $page->id }}"
                            class="w-full flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none hover:bg-gray-50 cursor-pointer tree-item {{ $currentPage?->id === $page->id ? 'active' : '' }}">
                            <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                            <span class="flex-1 truncate text-left">{{ $page->title }}</span>
                        </button>
                        @endif
                    @endforeach
                </div>
                @endif

                <div x-show="showInlineSectionInput" class="mt-1 md:mt-1.5 px-2 md:px-3 py-1">
                    <input type="text" wire:model="inlineSectionTitle" @keydown.enter="$wire.createSection(); showInlineSectionInput = false" @keydown.escape="showInlineSectionInput = false" @blur="$wire.createSection(); showInlineSectionInput = false" class="w-full px-2 py-1 text-xs md:text-[14px] border border-[#5B5FEF] rounded-none focus:outline-none" placeholder="New section title..." />
                </div>
            @endif
        </div>
    </nav>
</div>