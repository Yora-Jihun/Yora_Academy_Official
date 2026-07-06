<?php

namespace App\Livewire\Docs;

use App\Models\Doc;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;

class ManageDocs extends Component
{
    public ?Doc $doc = null;

    /**
     * List of user's docs for the landing preview when no doc is opened.
     *
     * @var array<int,array>
     */
    public array $docs = [];

    public ?Page $currentPage = null;

    public ?int $currentPageId = null;

    public array $collapsedSections = [];

    public string $pageContent = '';

    public string $search = '';

    public string $sort = 'created_desc';

    public ?int $editingSectionId = null;

    public ?int $editingPageId = null;

    public string $editingTitle = '';

    public string $inlineSectionTitle = '';

    public string $inlinePageTitle = '';

    public bool $showCreateDocModal = false;

    public string $newDocTitle = '';

    public string $newDocDescription = '';

    public bool $editingDocTitle = false;

    public ?string $docTitle = null;

    public ?string $docDescription = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'sort' => ['except' => 'created_desc'],
        'collapsedSections' => ['except' => []],
    ];

    protected $listeners = [
        'selectPage',
        'deletePage',
        'deleteSection',
        'updatePage',
        'updateSection',
        'toggleSection',
        'startRename',
    ];

    public function startRename(string $type, int $id): void
    {
        $this->editingSectionId = null;
        $this->editingPageId = null;

        if ($type === 'section') {
            $section = $this->doc?->sections->find($id);
            if ($section) {
                $this->editingSectionId = $id;
                $this->editingTitle = $section->title;
            }
        }

        if ($type === 'page') {
            $page = $this->doc?->pages->find($id) ?? Page::find($id);
            if ($page) {
                $this->editingPageId = $id;
                $this->editingTitle = $page->title;
            }
        }

        $this->dispatch('focus-rename', ['type' => $type, 'id' => $id]);
    }

    public function saveRename(): void
    {
        if ($this->editingPageId) {
            $this->updatePage($this->editingPageId, $this->editingTitle);
            $this->editingPageId = null;
            $this->editingTitle = '';

            return;
        }

        if ($this->editingSectionId) {
            $this->updateSection($this->editingSectionId, $this->editingTitle);
            $this->editingSectionId = null;
            $this->editingTitle = '';
        }
    }

    public function cancelRename(): void
    {
        $this->editingSectionId = null;
        $this->editingPageId = null;
        $this->editingTitle = '';
    }

    public function startEditDoc(): void
    {
        $this->docTitle = $this->doc->title;
        $this->docDescription = $this->doc->description;
        $this->editingDocTitle = true;
    }

    public function saveDocMeta(): void
    {
        if ($this->doc) {
            $this->doc->update([
                'title' => $this->docTitle,
                'description' => $this->docDescription,
            ]);
        }
        $this->editingDocTitle = false;
    }

    public function cancelEditDoc(): void
    {
        $this->editingDocTitle = false;
        $this->docTitle = $this->doc->title;
        $this->docDescription = $this->doc->description;
    }

    public function mount(?int $docId = null): void
    {
        $query = auth()->user()->docs()->with(['user', 'sections' => function ($query) {
            $query->orderBy('order');
        }, 'sections.pages' => function ($query) {
            $query->orderBy('order');
        }, 'pages' => function ($query) {
            $query->orderBy('order');
        }]);

        if ($docId) {
            $doc = $query->find($docId);

            if ($doc instanceof Doc) {
                $this->doc = $doc;
                $this->currentPage = $this->doc->sections->first()?->pages->first()
                    ?? $this->doc->pages->first();
                $this->currentPageId = $this->currentPage?->id;
                $this->pageContent = $this->currentPage->content ?? '';
                $this->docTitle = $this->doc->title;
                $this->docDescription = $this->doc->description;
            }
        } else {
            // No doc selected: load docs list for preview in the main workspace area
            $this->docs = auth()->user()->docs()->orderBy('created_at', 'desc')->get()->toArray();
        }
    }

    protected function refreshDoc(): void
    {
        if (! $this->doc) {
            return;
        }

        $this->doc = auth()->user()->docs()->with(['user', 'sections' => function ($query) {
            $query->orderBy('order');
        }, 'sections.pages' => function ($query) {
            $query->orderBy('order');
        }, 'pages' => function ($query) {
            $query->orderBy('order');
        }])->find($this->doc->id);

        if ($this->currentPageId) {
            $this->currentPage = Page::find($this->currentPageId);
            $this->pageContent = $this->currentPage->content ?? $this->pageContent;
        }
    }

    public function selectPage(int $pageId): void
    {
        $this->currentPageId = $pageId;

        $this->currentPage = Page::where('doc_id', $this->doc?->id)->findOrFail($pageId);
        $this->pageContent = $this->currentPage->content ?? '';
    }

    public function toggleSection(int $sectionId): void
    {
        if (in_array($sectionId, $this->collapsedSections, true)) {
            $this->collapsedSections = array_filter($this->collapsedSections, fn ($id) => $id !== $sectionId);

            return;
        }

        $this->collapsedSections[] = $sectionId;
    }

    public function updatedPageContent(string $content): void
    {
        if ($this->currentPage) {
            $this->currentPage->content = $content;
            $this->currentPage->update(['content' => $content]);
        }
    }

    public function openCreateDocModal(): void
    {
        $this->showCreateDocModal = true;
    }

    public function closeCreateDocModal(): void
    {
        $this->showCreateDocModal = false;
        $this->newDocTitle = '';
        $this->newDocDescription = '';
    }

    public function createSection(): void
    {
        if ($this->doc && $this->inlineSectionTitle) {
            Section::create([
                'doc_id' => $this->doc->id,
                'title' => $this->inlineSectionTitle,
                'order' => $this->doc->sections()->count(),
            ]);
            $this->inlineSectionTitle = '';
            $this->refreshDoc();
        }
    }

    public function createPageInline(?int $sectionId = null): void
    {
        if ($this->doc && $this->inlinePageTitle) {
            $baseSlug = Str::slug($this->inlinePageTitle);
            $slug = $this->uniqueSlug($baseSlug, $this->doc->id);

            $page = Page::create([
                'doc_id' => $this->doc->id,
                'section_id' => $sectionId,
                'title' => $this->inlinePageTitle,
                'slug' => $slug,
                'content' => '',
                'order' => $sectionId
                    ? ($this->doc->sections->find($sectionId)?->pages()->count() ?? 0)
                    : ($this->doc->pages->where('section_id', null)->count()),
            ]);

            $this->inlinePageTitle = '';
            $this->currentPage = $page;
            $this->pageContent = $page->content;
            $this->currentPageId = $page->id;
            $this->refreshDoc();
        }
    }

    public function createDoc(): void
    {
        if ($this->newDocTitle) {
            $this->doc = Doc::create([
                'user_id' => auth()->id(),
                'title' => $this->newDocTitle,
                'description' => $this->newDocDescription,
                'slug' => Str::slug($this->newDocTitle),
            ]);

            $this->currentPage = null;
            $this->pageContent = '';
            $this->newDocTitle = '';
            $this->newDocDescription = '';
            $this->showCreateDocModal = false;
            $this->mount($this->doc->id);
        }
    }

    public function togglePublish(): void
    {
        if ($this->doc) {
            $newState = ! $this->doc->is_public;
            $this->doc->update(['is_public' => $newState]);
            $this->doc->pages()->update(['is_public' => $newState]);
            $this->refreshDoc();
            $message = $newState ? 'Documentation published and is now publicly accessible.' : 'Documentation unpublished and is now private.';
            $this->dispatch('notify', message: $message);
        }
    }

    public function deleteDoc(int $docId): void
    {
        $doc = Doc::where('user_id', auth()->id())->findOrFail($docId);
        $doc->delete();
        $this->doc = null;
        $this->currentPage = null;
        $this->pageContent = '';
        $this->mount();
    }

    public function updateSection(int $sectionId, string $title): void
    {
        $section = Section::where('doc_id', $this->doc?->id)->findOrFail($sectionId);
        $section->update(['title' => $title]);
        $this->mount();
    }

    public function updatePage(int $pageId, string $title): void
    {
        $page = Page::where('doc_id', $this->doc?->id)->findOrFail($pageId);
        $baseSlug = Str::slug($title);
        $slug = $this->uniqueSlug($baseSlug, $this->doc?->id, $pageId);
        $page->update(['title' => $title, 'slug' => $slug]);

        if ($this->currentPage?->id === $pageId) {
            $this->currentPage = $page->fresh();
        }
        $this->mount();
    }

    public function deleteSection(int $sectionId): void
    {
        $section = Section::where('doc_id', $this->doc?->id)->findOrFail($sectionId);
        $section->delete();
        $this->mount();
    }

    public function deletePage(int $pageId): void
    {
        $page = Page::where('doc_id', $this->doc?->id)->findOrFail($pageId);

        if ($this->currentPage?->id === $pageId) {
            $this->currentPage = null;
            $this->pageContent = '';
        }

        $page->delete();
        $this->mount();
    }

    protected function uniqueSlug(string $slug, int $docId, ?int $excludeId = null): string
    {
        $originalSlug = $slug;
        $counter = 1;

        $query = Page::where('doc_id', $docId)->where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        while ($query->exists()) {
            $slug = $originalSlug.'-'.$counter;
            $counter++;
            $query = Page::where('doc_id', $docId)->where('slug', $slug)->where('id', '!=', $excludeId);
        }

        return $slug;
    }

    public function getFilteredDocsProperty()
    {
        $collection = collect($this->docs)
            ->when($this->search, function ($query) {
                $term = mb_strtolower($this->search);

                return $query->filter(function ($doc) use ($term) {
                    return str_contains(mb_strtolower($doc['title']), $term)
                        || str_contains(mb_strtolower($doc['description']), $term);
                });
            });

        return match ($this->sort) {
            'title_asc' => $collection->sortBy('title'),
            'title_desc' => $collection->sortByDesc('title'),
            'updated_asc' => $collection->sortBy('updated_at'),
            'updated_desc' => $collection->sortByDesc('updated_at'),
            'created_asc' => $collection->sortBy('created_at'),
            default => $collection->sortByDesc('created_at'),
        };
    }

    public function render(): View
    {
        return view('livewire.docs.manage')
            ->layout('layouts.docs', ['active' => 'docs']);
    }
}
