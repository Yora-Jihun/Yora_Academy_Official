<div>
    @auth
    <div class="flex h-screen">
        @include('livewire.docs.partials.sidebar', ['active' => 'docs'])

        <div class="flex-1 flex flex-col min-w-0 md:ml-[250px]">
            @include('livewire.docs.partials.headnavbar')

            <div class="flex flex-1 min-h-0">
                <div class="w-[280px] bg-white border-r border-[#EAEAEA] flex flex-col h-full hidden lg:flex">
                    <div class="px-4 py-4 border-b border-gray-100 flex items-center justify-between">
                        <h3 class="text-[11px] md:text-[13px] font-semibold text-gray-500 uppercase tracking-wider">Table of Contents</h3>
                        <div class="flex items-center gap-1">
                            <button type="button" wire:click="openSectionModal" class="p-1 rounded-none hover:bg-gray-50 text-gray-600" title="Add Section">
                                <x-icon name="folder-plus" class="w-4 h-4" />
                            </button>
                            <button type="button" wire:click="openPageModal(null)" class="p-1 rounded-none hover:bg-gray-50 text-gray-600" title="Add Page">
                                <x-icon name="document-plus" class="w-4 h-4" />
                            </button>
                        </div>
                    </div>

                    <nav class="flex-1 overflow-y-auto py-1.5 md:py-2">
                        <div class="px-3 md:px-4 space-y-0.5">
                            @if($doc)
                            @foreach($doc->sections as $section)
                            <div class="space-y-0.5 mt-1 md:mt-1.5" wire:key="section-{{ $section->id }}">
                                <div class="flex items-center justify-between gap-2 px-2 md:px-3 py-1.5 md:py-2 text-xs md:text-[14px] text-gray-800 rounded-none group">
                                    @if($editingSectionId === $section->id)
                                    <div class="flex items-center gap-2 flex-1">
                                        <x-icon name="folder-open" class="w-3.5 h-3.5 md:w-4 md:h-4 text-amber-500" />
                                        <input id="rename-section-{{ $section->id }}" wire:model.defer="editingTitle" wire:keydown.enter="saveRename" wire:keydown.escape="cancelRename" wire:blur="saveRename" class="w-full px-2 py-1 text-sm text-gray-900 border border-gray-200 rounded-none focus:outline-none focus:ring-2 focus:ring-[#5B5FEF]" placeholder="Rename section" autocomplete="off" />
                                    </div>
                                    <button type="button" wire:click="cancelRename" class="p-1 rounded-none text-gray-500 hover:text-gray-700" title="Cancel rename">
                                        <x-icon name="x" class="w-4 h-4" />
                                    </button>
                                    @else
                                    <button type="button" wire:click="toggleSection({{ $section->id }})" data-context-type="section" data-context-id="{{ $section->id }}" class="flex items-center gap-2 text-left flex-1">
                                        <x-icon name="{{ in_array($section->id, $collapsedSections, true) ? 'chevron-right' : 'chevron-down' }}" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-400" />
                                        <x-icon name="{{ in_array($section->id, $collapsedSections, true) ? 'folder' : 'folder-open' }}" class="w-3.5 h-3.5 md:w-4 md:h-4 text-amber-500" />
                                        <span>{{ $section->title }}</span>
                                    </button>
                                    <button type="button" wire:click="openPageModal({{ $section->id }})" class="p-1 rounded-none hover:bg-gray-50 text-gray-600 opacity-0 group-hover:opacity-100 transition focus:opacity-100" title="Add Page to Section">
                                        <x-icon name="document-plus" class="w-3.5 h-3.5" />
                                    </button>
                                    @endif
                                </div>

                                @unless(in_array($section->id, $collapsedSections, true))
                                <div class="ml-4 md:ml-6 space-y-0.5" wire:key="section-pages-{{ $section->id }}">
                                    @foreach($section->pages as $page)
                                    @if($editingPageId === $page->id)
                                    <div class="flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none bg-gray-50">
                                        <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                                        <input id="rename-page-{{ $page->id }}" wire:model.defer="editingTitle" wire:keydown.enter="saveRename" wire:keydown.escape="cancelRename" wire:blur="saveRename" class="w-full px-2 py-1 text-sm text-gray-900 border border-gray-200 rounded-none focus:outline-none focus:ring-2 focus:ring-[#5B5FEF]" placeholder="Rename page" autocomplete="off" />
                                    </div>
                                    @else
                                    <button
                                        type="button"
                                        wire:key="page-{{ $page->id }}"
                                        wire:click="selectPage({{ $page->id }})"
                                        data-context-type="page"
                                        data-context-id="{{ $page->id }}"
                                        wire:loading.attr="disabled"
                                        class="w-full flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none hover:bg-gray-50 cursor-pointer tree-item {{ $currentPage?->id === $page->id ? 'active' : '' }}"
                                    >
                                        <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                                        <span>{{ $page->title }}</span>
                                    </button>
                                    @endif
                                    @endforeach
                                </div>
                                @endunless
                            </div>
                            @endforeach

                            @if($doc->pages->where('section_id', null)->isNotEmpty())
                            <div class="space-y-0.5 mt-1 md:mt-1.5">
                                @foreach($doc->pages->where('section_id', null) as $page)
                                @if($editingPageId === $page->id)
                                <div class="flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none bg-gray-50">
                                    <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                                    <input id="rename-page-{{ $page->id }}" wire:model.defer="editingTitle" wire:keydown.enter="saveRename" wire:keydown.escape="cancelRename" wire:blur="saveRename" class="w-full px-2 py-1 text-sm text-gray-900 border border-gray-200 rounded-none focus:outline-none focus:ring-2 focus:ring-[#5B5FEF]" placeholder="Rename page" autocomplete="off" />
                                </div>
                                @else
                                <button
                                    type="button"
                                    wire:key="page-{{ $page->id }}"
                                    wire:click="selectPage({{ $page->id }})"
                                    data-context-type="page"
                                    data-context-id="{{ $page->id }}"
                                    wire:loading.attr="disabled"
                                    class="w-full flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none hover:bg-gray-50 cursor-pointer tree-item {{ $currentPage?->id === $page->id ? 'active' : '' }}"
                                >
                                    <x-icon name="document-text" class="w-3.5 h-3.5 md:w-4 md:h-4 text-gray-300" />
                                    <span>{{ $page->title }}</span>
                                </button>
                                @endif
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

                <main class="flex-1 flex min-h-0">
                    <div class="flex-1 flex flex-col min-w-0">
                        <div class="px-4 md:px-8 py-4 md:py-6 border-b border-gray-100 flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                            <div class="flex-1">
                                @if($editingDocTitle)
                                <input type="text" wire:model="docTitle" class="text-2xl md:text-3xl font-bold text-gray-900 w-full mb-2 border border-gray-200 rounded-none px-2 py-1 focus:outline-none focus:ring-2 focus:ring-[#5B5FEF]" placeholder="Documentation title">
                                <textarea wire:model="docDescription" class="w-full text-[13px] text-gray-600 border border-gray-200 rounded-none px-2 py-2 mt-1 focus:outline-none focus:ring-2 focus:ring-[#5B5FEF]" placeholder="Description" rows="5"></textarea>
                                <div class="flex gap-2 mt-3">
                                    <button type="button" wire:click="saveDocMeta" class="px-3 py-1 text-xs font-medium text-white bg-[#5B5FEF] rounded-none hover:bg-[#4A4DDF]">Save</button>
                                    <button type="button" wire:click="cancelEditDoc" class="px-3 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-none hover:bg-gray-200">Cancel</button>
                                </div>
                                @else
                                <div>
                                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $doc->title ?? 'No Documentation' }}</h1>
                                    @if($doc->description ?? false)
                                    <p class="text-[13px] text-gray-600 mt-1">{{ $doc->description }}</p>
                                    @endif
                                </div>
                                @endif
                            </div>

                            <div class="flex items-center gap-2">
                                @if($doc)
                                <button type="button" wire:click="togglePublish" wire:loading.attr="disabled" class="inline-flex items-center gap-2 rounded-none px-4 py-2 text-sm font-medium shadow-sm transition-all duration-200 active:scale-[0.98] {{ $doc->is_public ? 'bg-green-600 hover:bg-green-700 text-white' : 'bg-[#5B5FEF] hover:bg-[#4A4DDF] text-white' }}">
                                    <x-icon name="share" class="w-4 h-4" />
                                    <span>{{ $doc->is_public ? 'Published' : 'Publish' }}</span>
                                </button>
                                @endif
                                @if($isOwner && !$editingDocTitle)
                                <button type="button" wire:click="startEditDoc" class="p-1.5 rounded-none hover:bg-gray-50 text-gray-600" title="Edit documentation details">
                                    <x-icon name="pencil" class="w-4 h-4" />
                                </button>
                                @endif
                            </div>
                        </div>

                        @if($doc && $currentPage)
                        <input type="hidden" id="pageContentModel" wire:model.defer="pageContent">
                        <div x-data="docEditor(@js($pageContent))" class="flex flex-col min-h-0" @editor:load.window="reloadEditor($event.detail.content)">
                            <style>
                                #pageContent:empty:before { content: 'Start writing your documentation...'; color: #9ca3af; pointer-events: none; }
                            </style>
                            <div class="px-4 md:px-8 py-3 md:py-4 border-b border-gray-100 overflow-x-auto">
                                <div class="flex items-center gap-0.5 min-w-max">
                                    <button type="button" x-on:mousedown.prevent @click="bold()" class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Bold">
                                        <x-icon name="bold" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                                    </button>
                                    <button type="button" x-on:mousedown.prevent @click="italic()" class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Italic">
                                        <x-icon name="italic" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                                    </button>
                                    <div class="flex items-center gap-1 pl-1">
                                        <button type="button" x-on:mousedown.prevent @click="highlight('yellow')" class="w-5 h-5 rounded-full border border-black/10 hover:ring-2 hover:ring-gray-300 hover:ring-offset-1 transition" style="background-color:#fde68a" title="Yellow"></button>
                                        <button type="button" x-on:mousedown.prevent @click="highlight('green')" class="w-5 h-5 rounded-full border border-black/10 hover:ring-2 hover:ring-gray-300 hover:ring-offset-1 transition" style="background-color:#bbf7d0" title="Green"></button>
                                        <button type="button" x-on:mousedown.prevent @click="highlight('blue')" class="w-5 h-5 rounded-full border border-black/10 hover:ring-2 hover:ring-gray-300 hover:ring-offset-1 transition" style="background-color:#bfdbfe" title="Blue"></button>
                                        <button type="button" x-on:mousedown.prevent @click="highlight('pink')" class="w-5 h-5 rounded-full border border-black/10 hover:ring-2 hover:ring-gray-300 hover:ring-offset-1 transition" style="background-color:#fbcfe8" title="Pink"></button>
                                        <button type="button" x-on:mousedown.prevent @click="highlight('purple')" class="w-5 h-5 rounded-full border border-black/10 hover:ring-2 hover:ring-gray-300 hover:ring-offset-1 transition" style="background-color:#ddd6fe" title="Purple"></button>
                                        <button type="button" x-on:mousedown.prevent="saveSelection(); $refs.customColor.click()" class="w-5 h-5 rounded-full border border-black/10 hover:ring-2 hover:ring-gray-300 hover:ring-offset-1 transition overflow-hidden" style="background: conic-gradient(from 0deg, #fde68a, #bbf7d0, #bfdbfe, #fbcfe8, #ddd6fe, #fde68a)" title="Custom color"></button>
                                        <input type="color" x-ref="customColor" class="hidden" @change="restoreSelection(); highlight($event.target.value)">
                                    </div>
                                    <button type="button" x-on:mousedown.prevent @click="link()" class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Link">
                                        <x-icon name="link" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                                    </button>
                                    <button type="button" x-on:mousedown.prevent @click="image()" class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Image">
                                        <x-icon name="image" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                                    </button>
                                </div>
                            </div>

                            <div class="flex-1 overflow-y-auto px-4 md:px-8 py-4 md:py-8">
                                <article class="prose prose-gray max-w-none text-[13px] md:text-[15px]">
                                    <div id="pageContent" contenteditable="true" wire:ignore class="w-full h-full min-h-[400px] border-0 focus:outline-none resize-none text-[13px] md:text-[15px] outline-none" x-on:input.debounce.400ms="sync()" @blur="sync()"></div>
                                </article>
                            </div>
                        </div>
                        @endif
                    </div>

                    @hasSection('properties')
                    @yield('properties')
                    @else
                    @include('livewire.docs.partials.properties', ['doc' => $doc, 'currentPage' => $currentPage])
                    @endif
                </main>
            </div>
        </div>
    </div>
    @else
    <div class="flex h-screen">
        <div class="flex-1 flex flex-col min-h-0">
            <div class="sticky top-0 z-30 h-14 md:h-[72px] bg-white border-b border-gray-100 flex items-center justify-between px-4 md:px-6">
                <a href="{{ route('welcome') }}" wire:navigate class="flex items-center gap-3" aria-label="Yora Academy Home">
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-[#5B5FEF] rounded-none flex items-center justify-center shadow-sm">
                        <x-icon name="book-open" class="w-4 h-4 md:w-5 md:h-5 text-white" />
                    </div>
                    <span class="text-[15px] md:text-[17px] font-semibold text-gray-900">Yora Academy</span>
                </a>

                <div class="flex items-center gap-1.5 md:gap-3">
                    <a href="{{ route('login') }}" wire:navigate class="px-2.5 md:px-4 py-1 md:py-1.5 md:py-2.5 text-xs md:text-[14px] font-medium text-gray-600 bg-gray-50 rounded-none hover:bg-gray-100 transition">
                        Sign In
                    </a>
                    <a href="{{ route('register') }}" wire:navigate class="px-2.5 md:px-4 py-1 md:py-1.5 md:py-2.5 text-xs md:text-[14px] font-medium text-white bg-[#5B5FEF] rounded-none hover:bg-[#4A4DDF] transition">
                        Sign Up
                    </a>

                    <button type="button" aria-label="Toggle theme" class="p-1.5 md:p-2.5 rounded-none bg-gray-50 hover:bg-gray-100 transition">
                        <x-icon name="theme" class="w-3.5 h-3.5 md:w-5 md:h-5 text-gray-600" />
                    </button>
                </div>
            </div>

            @if($doc)
            <div class="flex flex-1 min-h-0">
                <div class="w-[280px] bg-white border-r border-[#EAEAEA] flex flex-col h-full hidden lg:flex">
                    @include('livewire.docs.partials.public-explorer', ['doc' => $doc, 'currentPage' => $currentPage])
                </div>

                <div class="flex-1 flex flex-col min-w-0">
                    @if($currentPage)
                    <div class="px-4 md:px-8 py-4 md:py-6 border-b border-gray-100 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $doc->title ?? 'No Documentation' }}</h1>
                            @if($doc->description ?? false)
                            <p class="text-[13px] text-gray-600 mt-1">{{ $doc->description }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="px-4 md:px-8 py-3 md:py-4 border-b border-gray-100 overflow-x-auto">
                        <div class="flex items-center gap-0.5 min-w-max">
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
                    <div class="flex-1 flex flex-col min-h-0">
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

                        <div class="px-3 md:px-4 py-3 md:py-4 space-y-3 md:space-y-4 flex-1">
                            <div>
                                <span class="text-[10px] md:text-[11px] text-gray-500 uppercase tracking-wider">Status</span>
                                <div class="mt-0.5 md:mt-1 flex gap-1.5">
                                    <span class="inline-flex items-center px-2 md:px-2.5 py-0.5 md:py-1 text-[11px] md:text-[12px] font-medium bg-green-100 text-green-700 rounded-full">Published</span>
                                    <span class="inline-flex items-center px-2 md:px-2.5 py-0.5 md:py-1 text-[11px] md:text-[12px] font-medium bg-[#F5F6FF] text-[#5B5FEF] rounded-full">Public</span>
                                </div>
                            </div>

                            @if($doc && $doc->user)
                            <div class="border-t border-gray-100 -mx-3 md:-mx-4 px-3 md:px-4 pt-3 md:pt-4">
                                <div class="flex items-center gap-2 md:gap-3">
                                    <img src="https://placehold.co/32x32/5B5FEF/white?text={{ substr($doc->user->fullname ?? 'A', 0, 1) }}" class="w-7 h-7 md:w-8 md:h-8 rounded-full" alt="Author">
                                    <div>
                                        <p class="text-[11px] md:text-[13px] font-medium text-gray-900">{{ $doc->user->fullname ?? 'Author' }}</p>
                                        <p class="text-[10px] md:text-[11px] text-gray-500">Maintainer</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="px-4 py-2 border-t border-gray-100 flex items-center gap-1.5 md:gap-2 text-[10px] md:text-[12px] text-gray-500">
                        <x-icon name="document-text" class="w-3 h-3 md:w-3.5 md:h-3.5" />
                        Published · Updated {{ $doc?->updated_at?->diffForHumans() ?? 'just now' }}
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
    @endauth

    <!-- Context Menu -->
    <div id="contextMenu" wire:ignore class="hidden z-60 bg-white dark:bg-slate-950 shadow-lg rounded-none" style="position:fixed; min-width:200px;">
        <div class="py-1">
            <button data-action="open" class="w-full flex items-center gap-3 px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-slate-900 transition">
                <x-icon name="document-text" class="w-4 h-4 text-gray-500 dark:text-gray-300" />
                <span>Open</span>
            </button>
            <button data-action="rename" class="w-full flex items-center gap-3 px-3 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-slate-900 transition">
                <x-icon name="pencil" class="w-4 h-4 text-gray-500 dark:text-gray-300" />
                <span>Rename</span>
            </button>
            <button data-action="delete" class="w-full flex items-center gap-3 px-3 py-2 text-sm text-red-600 hover:bg-gray-50 dark:hover:bg-slate-900 transition">
                <x-icon name="trash" class="w-4 h-4 text-red-600" />
                <span>Delete</span>
            </button>
        </div>
    </div>

    <script>
        (function() {
            const menu = document.getElementById('contextMenu');
            let currentType = null;
            let currentId = null;

            window.showContextMenu = function(e, type, id) {
                e.preventDefault();
                currentType = type;
                currentId = id;
                const x = Math.min(e.clientX, window.innerWidth - 220);
                const y = Math.min(e.clientY, window.innerHeight - 120);
                menu.style.left = x + 'px';
                menu.style.top = y + 'px';
                menu.classList.remove('hidden');
            }

            document.addEventListener('click', function(e) {
                if (!menu.contains(e.target)) {
                    menu.classList.add('hidden');
                }
            });
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') menu.classList.add('hidden');
            });

            document.addEventListener('contextmenu', function(e) {
                const target = e.target.closest('[data-context-type]');
                if (!target) {
                    return;
                }
                const type = target.dataset.contextType;
                const id = Number(target.dataset.contextId);
                if (type && id) {
                    showContextMenu(e, type, id);
                }
            });

            let livewireInstance = window.Livewire || window.livewire;
            const livewireQueue = [];

            function getComponentId() {
                const menu = document.getElementById('contextMenu');
                const root = menu ? menu.closest('[wire\\:id]') : null;
                return root ? root.getAttribute('wire:id') : null;
            }

            function emitOnComponent(eventName, ...args) {
                livewireInstance = window.Livewire || window.livewire || livewireInstance;
                const componentId = getComponentId();
                const component = componentId && livewireInstance && typeof livewireInstance.find === 'function' ? livewireInstance.find(componentId) : null;

                if (component) {
                    if (typeof component.call === 'function') {
                        return component.call(eventName, ...args);
                    }

                    if (component.$wire && typeof component.$wire[eventName] === 'function') {
                        return component.$wire[eventName](...args);
                    }
                }

                if (livewireInstance && typeof livewireInstance.dispatch === 'function') {
                    return livewireInstance.dispatch(eventName, ...args);
                }

                livewireQueue.push({
                    eventName,
                    args
                });
            }

            window.emitLivewireEvent = emitOnComponent;

            document.addEventListener('livewire:load', function() {
                livewireInstance = window.Livewire || window.livewire;
                while (livewireQueue.length) {
                    const {
                        eventName,
                        args
                    } = livewireQueue.shift();
                    emitOnComponent(eventName, ...args);
                }
            });

            window.addEventListener('focus-rename', function(event) {
                const {
                    type,
                    id
                } = event.detail;
                const input = document.getElementById(`rename-${type}-${id}`);
                if (input) {
                    input.focus();
                    input.select();
                }
            });

            menu.addEventListener('click', function(e) {
                const button = e.target.closest('button');
                const action = button ? button.dataset?.action : null;
                if (!action) return;
                menu.classList.add('hidden');

                if (action === 'open') {
                    if (currentType === 'page') {
                        emitLivewireEvent('selectPage', currentId);
                    } else if (currentType === 'section') {
                        emitLivewireEvent('toggleSection', currentId);
                    }
                }

                if (action === 'rename') {
                    emitLivewireEvent('startRename', currentType, currentId);
                }

                if (action === 'delete') {
                    const ok = window.confirm('Delete this ' + currentType + '? This action cannot be undone.');
                    if (!ok) return;
                    if (currentType === 'page') {
                        emitLivewireEvent('deletePage', currentId);
                    } else if (currentType === 'section') {
                        emitLivewireEvent('deleteSection', currentId);
                    }
                }
            });
        })();

        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.querySelector('[aria-label="Toggle theme"]');
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    document.documentElement.classList.toggle('dark');
                });
            }
        });
        function docEditor(initialContent) {
            return {
                open: false,
                savedRange: null,
                initialContent: initialContent || '',
                colors: {
                    yellow: '#fde68a',
                    green: '#bbf7d0',
                    blue: '#bfdbfe',
                    pink: '#fbcfe8',
                    purple: '#ddd6fe',
                },
                get el() { return document.getElementById('pageContent'); },
                init() {
                    const el = this.el;
                    if (el) el.innerHTML = this.initialContent;
                },
                reloadEditor(content) {
                    const node = this.el;
                    if (!node) return;
                    const html = content || '';
                    setTimeout(() => {
                        if (document.activeElement !== node) node.innerHTML = html;
                    }, 0);
                },
                exec(cmd, val) {
                    const el = this.el;
                    if (!el) return;
                    el.focus();
                    document.execCommand(cmd, false, val || null);
                    this.sync();
                },
                sync() {
                    const el = this.el;
                    const model = document.getElementById('pageContentModel');
                    if (!el || !model) return;
                    model.value = el.innerHTML;
                    model.dispatchEvent(new Event('input'));
                },
                bold() { this.exec('bold'); },
                italic() { this.exec('italic'); },
                underline() { this.exec('underline'); },
                highlight(color) {
                    const el = this.el;
                    if (!el) return;
                    el.focus();
                    document.execCommand('styleWithCSS', false, true);
                    const value = (typeof color === 'string' && color.startsWith('#')) ? color : (this.colors[color] || this.colors.yellow);
                    document.execCommand('hiliteColor', false, value);
                    this.sync();
                },
                saveSelection() {
                    const el = this.el;
                    const sel = window.getSelection();
                    if (el && sel && sel.rangeCount && el.contains(sel.anchorNode)) {
                        this.savedRange = sel.getRangeAt(0).cloneRange();
                    }
                },
                restoreSelection() {
                    const el = this.el;
                    if (!el || !this.savedRange) return;
                    el.focus();
                    const sel = window.getSelection();
                    sel.removeAllRanges();
                    sel.addRange(this.savedRange);
                },
                link() {
                    const url = prompt('Link URL:');
                    if (url) this.exec('createLink', url);
                },
                image() {
                    const url = prompt('Image URL:');
                    if (url) this.exec('insertImage', url);
                },
            };
        }
    </script>

    @if($showSectionModal)
    <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center" wire:click.self="closeSectionModal">
        <div class="bg-white rounded-none p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Add Section</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-[13px] text-gray-700 mb-1">Section Title</label>
                    <input type="text" wire:model="newSectionTitle" class="w-full px-3 py-2 border border-gray-200 rounded-none focus:outline-none focus:border-[#5B5FEF]" placeholder="Enter section title">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" wire:click="closeSectionModal" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-none hover:bg-gray-200">Cancel</button>
                    <button type="button" wire:click="createSection" class="px-4 py-2 text-white bg-[#5B5FEF] rounded-none hover:bg-[#4A4DDF]">Create</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($showPageModal)
    <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center" wire:click.self="closePageModal">
        <div class="bg-white rounded-none p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Add Page{{ $currentSection ? ' to ' . $currentSection->title : '' }}</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-[13px] text-gray-700 mb-1">Page Title</label>
                    <input type="text" wire:model="newPageTitle" class="w-full px-3 py-2 border border-gray-200 rounded-none focus:outline-none focus:border-[#5B5FEF]" placeholder="Enter page title">
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" wire:click="closePageModal" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-none hover:bg-gray-200">Cancel</button>
                    <button type="button" wire:click="createPage" class="px-4 py-2 text-white bg-[#5B5FEF] rounded-none hover:bg-[#4A4DDF]">Create</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>