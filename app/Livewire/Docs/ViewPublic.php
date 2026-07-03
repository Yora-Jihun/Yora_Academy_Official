<?php

namespace App\Livewire\Docs;

use App\Models\Doc;
use App\Models\Page;
use Illuminate\View\View;
use Livewire\Component;

class ViewPublic extends Component
{
    public string $slug;

    public ?Doc $doc = null;

    public ?Page $currentPage = null;

    public array $collapsedSections = [];

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
    }

    public function selectPage(int $pageId): void
    {
        $this->currentPage = Page::where('is_public', true)
            ->whereHas('doc', fn ($q) => $q->where('slug', $this->slug))
            ->find($pageId);
    }

    public function toggleSection(int $sectionId): void
    {
        if (in_array($sectionId, $this->collapsedSections, true)) {
            $this->collapsedSections = array_filter($this->collapsedSections, fn ($id) => $id !== $sectionId);

            return;
        }

        $this->collapsedSections[] = $sectionId;
    }

    public function render(): View
    {
        return view('livewire.docs.view-public')
            ->layout('layouts.public-docs', [
                'active' => 'explore',
                'doc' => $this->doc,
                'currentPage' => $this->currentPage,
            ]);
    }
}
