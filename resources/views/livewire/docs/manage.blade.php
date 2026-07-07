<div id="manage-docs-root">
    <div class="flex h-screen">
        @include('livewire.docs.partials.sidebar', ['active' => 'docs'])

        <div class="flex-1 flex flex-col min-w-0 md:ml-[250px]">
            @include('livewire.docs.partials.headnavbar')

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
                @include('livewire.docs.partials.explorer-inline', ['doc' => $doc, 'currentPage' => $currentPage])

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
                                @if(!$editingDocTitle)
                                <button type="button" wire:click="startEditDoc" class="p-1.5 rounded-none hover:bg-gray-50 text-gray-600" title="Edit documentation details">
                                    <x-icon name="pencil" class="w-4 h-4" />
                                </button>
                                @endif
                            </div>
                        </div>

                        @if($doc && $currentPage)
                        <div x-data="docEditor(@js($pageContent))" class="relative flex flex-col min-h-0" @editor:load.window="reloadEditor($event.detail.content)">
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
                                    <button type="button" x-on:mousedown.prevent @click="openCode()" class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Code block">
                                        <x-icon name="code" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                                    </button>

                                    <template x-if="showCodeModal">
                                        <div class="absolute left-0 right-0 top-full z-20 border-b border-gray-100 bg-gray-50 px-4 md:px-8 py-3 flex flex-col gap-2">
                                            <div class="flex items-center gap-2">
                                                <select x-model="codeLang" class="h-8 text-xs text-gray-600 bg-white border border-gray-200 rounded-none focus:outline-none focus:ring-2 focus:ring-[#5B5FEF]">
                                                    <option value="php">PHP</option>
                                                    <option value="javascript">JavaScript</option>
                                                    <option value="typescript">TypeScript</option>
                                                    <option value="python">Python</option>
                                                    <option value="bash">Bash</option>
                                                    <option value="json">JSON</option>
                                                    <option value="html">HTML</option>
                                                    <option value="xml">XML</option>
                                                    <option value="css">CSS</option>
                                                    <option value="sql">SQL</option>
                                                    <option value="plaintext">Plain text</option>
                                                </select>
                                                <button type="button" @click="insertCodeFromModal()" class="px-3 py-1 text-xs font-medium text-white bg-[#5B5FEF] rounded-none hover:bg-[#4A4DDF]">Insert</button>
                                                <button type="button" @click="closeCode()" class="px-3 py-1 text-xs font-medium text-gray-600 bg-gray-100 rounded-none hover:bg-gray-200">Cancel</button>
                                            </div>
                                            <textarea x-model="codeText" rows="4" placeholder="Paste your code here" class="w-full text-xs text-gray-700 border border-gray-200 rounded-none px-2 py-1.5 focus:outline-none focus:ring-2 focus:ring-[#5B5FEF] font-mono"></textarea>
                                        </div>
                                    </template>

                                    <div class="w-px h-5 bg-gray-200 mx-1"></div>

                                    <button type="button" x-on:mousedown.prevent @click="underline()" class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Underline">
                                        <x-icon name="underline" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                                    </button>
                                    <button type="button" x-on:mousedown.prevent @click="alignLeft()" class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Align left">
                                        <x-icon name="align-left" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                                    </button>
                                    <button type="button" x-on:mousedown.prevent @click="alignCenter()" class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Align center">
                                        <x-icon name="align-center" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                                    </button>
                                    <button type="button" x-on:mousedown.prevent @click="alignRight()" class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Align right">
                                        <x-icon name="align-right" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                                    </button>
                                    <button type="button" x-on:mousedown.prevent @click="alignJustify()" class="p-1.5 md:p-2 rounded-none hover:bg-gray-50 text-gray-600" title="Justify">
                                        <x-icon name="align-justify" class="w-3.5 h-3.5 md:w-4 md:h-4" />
                                    </button>

                                    <div class="w-px h-5 bg-gray-200 mx-1"></div>

                                    <div class="relative">
                                        <select x-on:change="fontSize($event.target.value); $event.target.selectedIndex = 0" class="appearance-none h-8 w-24 pl-2 pr-7 text-xs text-gray-600 bg-white border border-gray-200 rounded-none focus:outline-none focus:ring-2 focus:ring-[#5B5FEF]" title="Font size">
                                            <option value="" disabled selected>Font size</option>
                                            <option value="12">12px</option>
                                            <option value="14">14px</option>
                                            <option value="16">16px</option>
                                            <option value="18">18px</option>
                                            <option value="20">20px</option>
                                            <option value="24">24px</option>
                                            <option value="28">28px</option>
                                            <option value="32">32px</option>
                                            <option value="36">36px</option>
                                            <option value="48">48px</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-1.5 text-gray-400">
                                            <x-icon name="chevron-down" class="w-3.5 h-3.5" />
                                        </div>
                                    </div>
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
            @endif
        </div>
    </div>

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
                showCodeModal: false,
                codeLang: 'php',
                codeText: '',
                openCode() { this.showCodeModal = true; },
                closeCode() { this.showCodeModal = false; this.codeText = ''; },
                insertCodeFromModal() {
                    if (this.codeText.trim()) {
                        this.insertCode(this.codeLang, this.codeText);
                    }
                    this.closeCode();
                },
                insertCode(lang, code) {
                    const el = this.el;
                    if (!el) return;
                    el.focus();
                    const pre = document.createElement('pre');
                    const codeEl = document.createElement('code');
                    codeEl.className = 'language-' + (lang || 'plaintext');
                    codeEl.textContent = code || '';
                    pre.appendChild(codeEl);
                    const sel = window.getSelection();
                    if (sel && sel.rangeCount && el.contains(sel.anchorNode)) {
                        const range = sel.getRangeAt(0);
                        range.deleteContents();
                        range.insertNode(pre);
                        const after = document.createRange();
                        after.setStartAfter(pre);
                        after.collapse(true);
                        sel.removeAllRanges();
                        sel.addRange(after);
                    } else {
                        el.appendChild(pre);
                    }
                    this.sync();
                },
                get el() { return document.getElementById('pageContent'); },
                init() {
                    const el = this.el;
                    if (el) el.innerHTML = this.initialContent;
                },
                reloadEditor(content) {
                    const node = this.el;
                    if (!node) return;
                    node.innerHTML = content || '';
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
                    if (!el) return;
                    const html = el.innerHTML;
                    if (this.$wire) {
                        this.$wire.saveEditorContent(html);
                    } else if (window.Livewire) {
                        Livewire.dispatch('editor:save', { html });
                    }
                },
                bold() { this.exec('bold'); },
                italic() { this.exec('italic'); },
                underline() { this.exec('underline'); },
                alignLeft() { this.exec('justifyLeft'); },
                alignCenter() { this.exec('justifyCenter'); },
                alignRight() { this.exec('justifyRight'); },
                alignJustify() { this.exec('justifyFull'); },
                fontSize(px) {
                    const el = this.el;
                    if (!el) return;
                    el.focus();
                    const selection = window.getSelection();
                    if (!selection || !selection.rangeCount) return;
                    const size = parseInt(px, 10);
                    if (!size) return;
                    const range = selection.getRangeAt(0);
                    const span = document.createElement('span');
                    span.style.fontSize = size + 'px';
                    if (selection.isCollapsed) {
                        span.innerHTML = '​';
                        range.insertNode(span);
                        const r = document.createRange();
                        r.setStart(span.firstChild, 1);
                        r.collapse(true);
                        selection.removeAllRanges();
                        selection.addRange(r);
                    } else {
                        try {
                            span.appendChild(range.extractContents());
                            range.insertNode(span);
                            const r = document.createRange();
                            r.selectNodeContents(span);
                            selection.removeAllRanges();
                            selection.addRange(r);
                        } catch (e) {}
                    }
                    this.sync();
                },
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
                        const el = document.getElementById('pageContent');
                        emitLivewireEvent('selectPage', currentId, el ? el.innerHTML : null);
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

        window.addEventListener('livewire:load', function() {
            if (window.Livewire) {
                Livewire.on('notify', (data) => {
                    alert(data.message);
                });
            }
        });
    </script>
</div>