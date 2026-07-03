<div id="manage-docs-root">
    <div class="flex h-screen">
        @include('livewire.docs.partials.sidebar', ['active' => 'docs'])

        <div class="flex-1 flex flex-col min-w-0 md:ml-[250px]">
            @include('livewire.docs.partials.headnavbar')

            {{-- Top-level docs list preview when no doc selected --}}
            @unless($doc)
            @php $filteredDocs = $this->filteredDocs; @endphp
            <section class="w-full flex-1 min-h-[calc(100vh-72px)] bg-gradient-to-b from-[#EEF2FF] via-white to-white">
                <div class="max-w-7xl mx-auto px-6 py-6 grid gap-4 lg:grid-cols-[minmax(0,1fr)_200px] lg:items-center">
                    <div>
                        <h2 class="text-2xl font-semibold text-[#5B5FEF]">Your Documentation</h2>
                        <p class="text-sm text-gray-500 mt-1">Manage and open your docs below.</p>
                    </div>
                    <div class="text-right text-sm text-gray-500">
                        Showing {{ $filteredDocs->count() }} {{ \Illuminate\Support\Str::plural('doc', $filteredDocs->count()) }}
                    </div>
                </div>

                <div class="max-w-7xl mx-auto px-6 pb-6 space-y-4">

                    <div class="grid gap-3 sm:grid-cols-[minmax(0,1fr)_auto] sm:items-center">
                        <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                            <label for="doc-search" class="sr-only">Search docs</label>
                            <div class="relative flex-1 min-w-0 sm:min-w-[300px]">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <x-icon name="search" class="w-4 h-4" />
                                </div>
                                <input id="doc-search" type="search" wire:model.debounce.300ms="search" class="w-full h-10 rounded-none border border-gray-200 bg-gray-50 py-1.5 pl-10 pr-3 text-sm text-gray-900 leading-none focus:outline-none focus:ring-2 focus:ring-[#5B5FEF]" placeholder="Search docs" />
                            </div>

                            <label for="doc-sort" class="sr-only">Sort docs</label>
                            <div class="relative w-full sm:w-[220px]">
                                <select id="doc-sort" wire:model="sort" class="appearance-none h-10 rounded-none border border-gray-200 bg-white py-1.5 pr-8 pl-3 text-sm text-gray-700 leading-none focus:outline-none focus:ring-2 focus:ring-[#5B5FEF] w-full">
                                    <option value="created_desc">Newest first</option>
                                    <option value="created_asc">Oldest first</option>
                                    <option value="updated_desc">Recently updated</option>
                                    <option value="updated_asc">Least recently updated</option>
                                    <option value="title_asc">Title A → Z</option>
                                    <option value="title_desc">Title Z → A</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400">
                                    <x-icon name="chevron-down" class="w-4 h-4" />
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-end items-center pt-2 sm:pt-0">
                            <button wire:click="openCreateDocModal" class="inline-flex items-center justify-center gap-2 w-full sm:w-[220px] h-10 px-4 bg-[#5B5FEF] text-white hover:bg-[#4A4DDF] transition">
                                <x-icon name="document-plus" class="w-4 h-4" />
                                Create new doc
                            </button>
                        </div>
                    </div>

                    @if($filteredDocs->isEmpty())
                    <div class="rounded-none border border-dashed border-gray-200 bg-gray-50 px-4 py-6 text-center text-gray-600">
                        {{ $search ? 'No docs match your search.' : 'No docs yet.' }}
                    </div>
                    @else
                    <ul class="divide-y divide-gray-100">
                        @foreach($filteredDocs as $d)
                        <li class="py-3">
                            <a href="{{ route('docs', ['docId' => $d['id']]) }}" class="block p-4 hover:bg-slate-100 transition-colors rounded-none">
                                <div class="grid gap-4 items-start sm:grid-cols-[minmax(0,1fr)]">
                                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 min-w-0">
                                        <div class="w-10 h-10 bg-gray-50 flex items-center justify-center">
                                            <x-icon name="document-text" class="w-5 h-5 text-gray-500" />
                                        </div>
                                        <div class="min-w-0 space-y-1">
                                            <div class="font-medium text-gray-900 truncate">{{ $d['title'] }}</div>
                                            <div class="text-sm text-gray-500 truncate">{{ $d['description'] }}</div>
                                            <div class="text-xs text-gray-500 opacity-70">Updated {{ \Carbon\Carbon::parse($d['updated_at'])->diffForHumans() }} · Created {{ \Carbon\Carbon::parse($d['created_at'])->format('M j, Y @ H:i') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </section>
            @endunless

            @if($doc)
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
                                    <button type="button" wire:key="page-{{ $page->id }}" wire:click="selectPage({{ $page->id }})" data-context-type="page" data-context-id="{{ $page->id }}" wire:loading.attr="disabled" class="w-full flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none hover:bg-gray-50 cursor-pointer tree-item {{ $currentPage?->id === $page->id ? 'active' : '' }}">
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
                                <button type="button" wire:key="page-{{ $page->id }}" wire:click="selectPage({{ $page->id }})" data-context-type="page" data-context-id="{{ $page->id }}" wire:loading.attr="disabled" class="w-full flex items-center gap-2 px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-[14px] text-gray-600 rounded-none hover:bg-gray-50 cursor-pointer tree-item {{ $currentPage?->id === $page->id ? 'active' : '' }}">
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
                        <div class="px-4 md:px-8 py-4 md:py-6 border-b border-gray-100 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                            <div>
                                <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $doc->title ?? 'No Documentation' }}</h1>
                                @if($doc->description ?? false)
                                <p class="text-[13px] text-gray-600 mt-1">{{ $doc->description }}</p>
                                @endif
                            </div>

@if($doc)
                             <button type="button" wire:click="togglePublish" wire:loading.attr="disabled" class="inline-flex items-center gap-2 rounded-none px-4 py-2 text-sm font-medium shadow-sm transition-all duration-200 active:scale-[0.98] {{ $doc->is_public ? 'bg-green-600 hover:bg-green-700 text-white' : 'bg-[#5B5FEF] hover:bg-[#4A4DDF] text-white' }}">
                                 <x-icon name="share" class="w-4 h-4" />
                                 <span>{{ $doc->is_public ? 'Published' : 'Publish' }}</span>
                             </button>
                             @endif
                        </div>

                        @if($doc && $currentPage)
                        <div class="px-4 md:px-8 py-3 md:py-4 border-b border-gray-100 overflow-x-auto">
                            <div class="flex items-center gap-0.5 min-w-max">
                                <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Bold">
                                    <x-icon name="bold" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                                </button>
                                <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Italic">
                                    <x-icon name="italic" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                                </button>
                                <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Link">
                                    <x-icon name="link" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                                </button>
                                <button class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Image">
                                    <x-icon name="image" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                                </button>
                            </div>
                        </div>

                        <div class="flex-1 overflow-y-auto px-4 md:px-8 py-4 md:py-8">
                            <article class="prose prose-gray max-w-none text-[13px] md:text-[15px]">
                                <textarea wire:model.defer="pageContent" class="w-full h-full min-h-[400px] border-0 focus:outline-none resize-none text-[13px] md:text-[15px]" placeholder="Start writing your documentation..."></textarea>
                            </article>
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
            @endif
        </div>
    </div>

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

    @if($showCreateDocModal)
    <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center" wire:click.self="closeCreateDocModal">
        <div class="bg-white rounded-none p-6 w-96">
            <h3 class="text-lg font-semibold mb-4">Create Documentation</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-[13px] text-gray-700 mb-1">Title</label>
                    <input type="text" wire:model="newDocTitle" class="w-full px-3 py-2 border border-gray-200 rounded-none focus:outline-none focus:border-[#5B5FEF]" placeholder="Documentation title">
                </div>
                <div>
                    <label class="block text-[13px] text-gray-700 mb-1">Description</label>
                    <textarea wire:model="newDocDescription" class="w-full px-3 py-2 border border-gray-200 rounded-none focus:outline-none focus:border-[#5B5FEF]" placeholder="Optional description" rows="3"></textarea>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" wire:click="closeCreateDocModal" class="px-4 py-2 text-gray-600 bg-gray-100 rounded-none hover:bg-gray-200">Cancel</button>
                    <button type="button" wire:click="createDoc" class="px-4 py-2 text-white bg-[#5B5FEF] rounded-none hover:bg-[#4A4DDF]">Create</button>
                </div>
            </div>
        </div>
    </div>
    @endif

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
                const rect = document.documentElement.getBoundingClientRect();
                const x = Math.min(e.clientX, window.innerWidth - 220);
                const y = Math.min(e.clientY, window.innerHeight - 120);
                menu.style.left = x + 'px';
                menu.style.top = y + 'px';
                menu.classList.remove('hidden');
            }

            // Close on outside click or Escape
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
                    eventName
                    , args
                });
            }

            window.emitLivewireEvent = emitOnComponent;

            document.addEventListener('livewire:load', function() {
                livewireInstance = window.Livewire || window.livewire;
                while (livewireQueue.length) {
                    const {
                        eventName
                        , args
                    } = livewireQueue.shift();
                    emitOnComponent(eventName, ...args);
                }
            });

            window.addEventListener('focus-rename', function(event) {
                const {
                    type
                    , id
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

        Livewire.on('notify', (data) => {
            alert(data.message);
        });
    </script>
</div>
</div>

