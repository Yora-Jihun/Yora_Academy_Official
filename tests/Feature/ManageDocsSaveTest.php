<?php

namespace Tests\Feature;

use App\Livewire\Docs\ManageDocs;
use App\Models\Doc;
use App\Models\Page;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ManageDocsSaveTest extends TestCase
{
    use RefreshDatabase;

    private function makeDocWithPages(User $user): array
    {
        $doc = Doc::create([
            'user_id' => $user->id,
            'title' => 'Test Documentation',
            'slug' => 'test-docs',
            'is_public' => false,
        ]);

        $page1 = Page::create([
            'doc_id' => $doc->id,
            'title' => 'Page One',
            'slug' => 'page-one',
            'content' => '<p>original one</p>',
            'order' => 0,
        ]);

        $page2 = Page::create([
            'doc_id' => $doc->id,
            'title' => 'Page Two',
            'slug' => 'page-two',
            'content' => '<p>original two</p>',
            'order' => 1,
        ]);

        return [$doc, $page1, $page2];
    }

    public function test_switching_page_saves_current_page_content(): void
    {
        $user = User::factory()->create();
        [$doc, $page1, $page2] = $this->makeDocWithPages($user);

        Livewire::actingAs($user)
            ->test(ManageDocs::class, ['docId' => $doc->id])
            ->assertSet('currentPageId', $page1->id)
            ->call('selectPage', $page2->id, '<p>edited page one</p>')
            ->assertSet('currentPageId', $page2->id);

        $this->assertDatabaseHas('pages', [
            'id' => $page1->id,
            'content' => '<p>edited page one</p>',
        ]);
    }

    public function test_editor_save_persists_content(): void
    {
        $user = User::factory()->create();
        [$doc, $page1, $page2] = $this->makeDocWithPages($user);

        Livewire::actingAs($user)
            ->test(ManageDocs::class, ['docId' => $doc->id])
            ->call('saveEditorContent', '<p>autosaved content</p>')
            ->assertHasNoErrors();

        $this->assertDatabaseHas('pages', [
            'id' => $page1->id,
            'content' => '<p>autosaved content</p>',
        ]);
    }
}
