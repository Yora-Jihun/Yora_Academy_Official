<?php

namespace App\Livewire\Docs;

use App\Models\Doc;
use App\Models\Page;
use App\Models\Section;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Attributes\On;

class ViewPublic extends Component
{
    public string $slug;

    public ?Doc $doc = null;

    public ?Page $currentPage = null;

    public ?int $currentPageId = null;

    public array $collapsedSections = [];

    public ?int $editingSectionId = null;

    public ?int $editingPageId = null;

    public string $editingTitle = '';

    public string $pageContent = '';

    public bool $showSectionModal = false;

    public bool $showPageModal = false;

    public ?int $currentSection = null;

    public string $newSectionTitle = '';

    public string $newPageTitle = '';

    public bool $isOwner = false;

    public bool $editingDocTitle = false;

    public ?string $docTitle = null;

    public ?string $docDescription = null;

    protected $listeners = [
        'selectPage',
        'deletePage',
        'deleteSection',
        'updatePage',
        'updateSection',
        'toggleSection',
        'startRename',
    ];

    public function mount(string $slug): void
    {
        $this->doc = Doc::where('slug', $slug)
            ->where('is_public', true)
            ->with(['user', 'sections' => function ($query) {
                $query->orderBy('order');
            }, 'sections.pages' => function ($query) {
                $query->where('is_public', true)
                    ->orderBy('order');
            }, 'pages' => function ($query) {
                $query->where('is_public', true)
                    ->orderBy('order');
            }])
            ->firstOrFail();

        $this->currentPage = $this->doc->sections->first()?->pages->first()
            ?? $this->doc->pages->first();
        $this->currentPageId = $this->currentPage?->id;
        $this->pageContent = $this->currentPage->content ?? '';
        $this->isOwner = auth()->check() && $this->doc->user_id === auth()->id();
        $this->docTitle = $this->doc->title;
        $this->docDescription = $this->doc->description;
    }

    public function togglePublish(): void
    {
        if ($this->doc && $this->isOwner) {
            $newState = ! $this->doc->is_public;
            $this->doc->update(['is_public' => $newState]);
            $this->doc->pages()->update(['is_public' => $newState]);
            $this->doc = $this->doc->fresh();
            $message = $newState ? 'Documentation published and is now publicly accessible.' : 'Documentation unpublished and is now private.';
            $this->dispatch('notify', message: $message);
        }
    }

    public function selectPage(int $pageId): void
    {
        $this->currentPageId = $pageId;
        $this->currentPage = Page::where('is_public', true)
            ->whereHas('doc', fn ($q) => $q->where('slug', $this->slug))
            ->find($pageId);
        $this->pageContent = $this->currentPage?->content ?? '';
        $this->dispatch('editor:load', ['content' => $this->pageContent]);
    }

    public function toggleSection(int $sectionId): void
    {
        if (in_array($sectionId, $this->collapsedSections, true)) {
            $this->collapsedSections = array_filter($this->collapsedSections, fn ($id) => $id !== $sectionId);

            return;
        }

        $this->collapsedSections[] = $sectionId;
    }

    public function openSectionModal(): void
    {
        $this->showSectionModal = true;
    }

    public function closeSectionModal(): void
    {
        $this->showSectionModal = false;
        $this->newSectionTitle = '';
    }

    public function openPageModal(?int $sectionId = null): void
    {
        $this->currentSection = $sectionId ? $this->doc->sections->find($sectionId) : null;
        $this->showPageModal = true;
    }

    public function closePageModal(): void
    {
        $this->showPageModal = false;
        $this->currentSection = null;
        $this->newPageTitle = '';
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

    public function createSection(): void
    {
        if ($this->doc && $this->newSectionTitle) {
            Section::create([
                'doc_id' => $this->doc->id,
                'title' => $this->newSectionTitle,
                'order' => $this->doc->sections()->count(),
            ]);

            $this->newSectionTitle = '';
            $this->showSectionModal = false;
            $this->doc = $this->doc->fresh()->load(['sections' => function ($q) {
                $q->orderBy('order');
            }, 'sections.pages' => function ($q) {
                $q->orderBy('order');
            }]);
        }
    }

    public function createPage(?int $sectionId = null): void
    {
        if ($this->doc && $this->newPageTitle) {
            $sectionId = $sectionId ?? $this->currentSection?->id;
            $baseSlug = Str::slug($this->newPageTitle);
            $slug = $this->uniqueSlug($baseSlug, $this->doc->id);

            $page = Page::create([
                'doc_id' => $this->doc->id,
                'section_id' => $sectionId,
                'title' => $this->newPageTitle,
                'slug' => $slug,
                'content' => '',
                'order' => $sectionId
                    ? $this->doc->sections->find($sectionId)?->pages()->count() ?? 0
                    : $this->doc->pages->where('section_id', null)->count(),
            ]);

            $this->newPageTitle = '';
            $this->showPageModal = false;
            $this->currentSection = null;
            $this->currentPage = $page;
            $this->pageContent = $page->content;
            $this->doc = $this->doc->fresh()->load(['sections' => function ($q) {
                $q->orderBy('order');
            }, 'sections.pages' => function ($q) {
                $q->orderBy('order');
            }]);
            $this->dispatch('editor:load', ['content' => $this->pageContent]);
        }
    }

    public function startRename(string $type, int $id): void
    {
        $this->editingSectionId = null;
        $this->editingPageId = null;

        if ($type === 'section') {
            $section = $this->doc->sections->find($id);
            if ($section) {
                $this->editingSectionId = $id;
                $this->editingTitle = $section->title;
            }
        }

        if ($type === 'page') {
            $page = $this->doc->sections->flatMap->pages->find($id) ?? $this->doc->pages->find($id);
            if ($page) {
                $this->editingPageId = $id;
                $this->editingTitle = $page->title;
            }
        }
    }

    public function saveRename(): void
    {
        if ($this->editingPageId) {
            $page = Page::find($this->editingPageId);
            if ($page) {
                $page->update(['title' => $this->editingTitle, 'slug' => $this->uniqueSlug(Str::slug($this->editingTitle), $this->doc->id, $this->editingPageId)]);
            }
            $this->editingPageId = null;
            $this->editingTitle = '';

            return;
        }

        if ($this->editingSectionId) {
            $section = Section::find($this->editingSectionId);
            if ($section) {
                $section->update(['title' => $this->editingTitle]);
            }
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
        if ($this->doc && $this->isOwner) {
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

    public function deleteSection(int $sectionId): void
    {
        $section = Section::where('doc_id', $this->doc->id)->find($sectionId);
        if ($section) {
            $section->delete();
        }
        $this->doc = $this->doc->fresh()->load(['sections' => function ($q) {
            $q->orderBy('order');
        }, 'sections.pages' => function ($q) {
            $q->orderBy('order');
        }]);
    }

    public function deletePage(int $pageId): void
    {
        $page = Page::where('doc_id', $this->doc->id)->find($pageId);
        if ($page) {
            if ($this->currentPage?->id === $pageId) {
                $this->currentPage = null;
                $this->pageContent = '';
            }
            $page->delete();
        }
        $this->doc = $this->doc->fresh()->load(['sections' => function ($q) {
            $q->orderBy('order');
        }, 'sections.pages' => function ($q) {
            $q->orderBy('order');
        }]);
        $this->dispatch('editor:load', ['content' => $this->pageContent]);
    }

    #[On('editor:save')]
    public function saveEditorContent($html): void
    {
        if ($this->currentPage) {
            $this->pageContent = $html;
            $this->currentPage->update(['content' => $html]);
        }
    }

    public function updatedPageContent(string $content): void
    {
        if ($this->currentPage) {
            $this->currentPage->update(['content' => $content]);
        }
    }

    public function render(): View
    {
        return view('livewire.docs.view-public')
            ->layout('layouts.docs', ['active' => 'docs']);
    }
}
