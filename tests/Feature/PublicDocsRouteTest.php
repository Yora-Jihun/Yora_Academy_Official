<?php

namespace Tests\Feature;

use App\Models\Doc;
use App\Models\Page;
use App\Models\Section;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicDocsRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_docs_routes_are_accessible_without_authentication(): void
    {
        $user = User::factory()->create();
        $doc = Doc::create([
            'user_id' => $user->id,
            'title' => 'Test Documentation',
            'description' => 'A test doc for public viewing',
            'slug' => 'test-docs',
            'is_public' => true,
        ]);

        $this->get(route('public.docs.show', $doc->slug))
            ->assertOk();
    }

    public function test_explore_docs_route_is_accessible_without_authentication(): void
    {
        $this->get(route('docs.explore'))
            ->assertOk();
    }

    public function test_private_docs_return_404(): void
    {
        $user = User::factory()->create();
        $doc = Doc::create([
            'user_id' => $user->id,
            'title' => 'Private Documentation',
            'slug' => 'private-docs',
            'is_public' => false,
        ]);

        $this->get(route('public.docs.show', $doc->slug))
            ->assertNotFound();
    }

    public function test_nonexistent_docs_return_404(): void
    {
        $this->get(route('public.docs.show', 'nonexistent'))
            ->assertNotFound();
    }

    public function test_public_doc_shows_sections_and_pages(): void
    {
        $user = User::factory()->create();
        $doc = Doc::create([
            'user_id' => $user->id,
            'title' => 'Test Documentation',
            'slug' => 'test-docs',
            'is_public' => true,
        ]);

        $section = Section::create([
            'doc_id' => $doc->id,
            'title' => 'Getting Started',
            'order' => 1,
        ]);

        $page = Page::create([
            'doc_id' => $doc->id,
            'section_id' => $section->id,
            'title' => 'Introduction',
            'slug' => 'introduction',
            'content' => '<h2>Introduction</h2><p>Welcome to this docs page.</p>',
            'is_public' => true,
            'order' => 1,
        ]);

        $response = $this->get(route('public.docs.show', $doc->slug));

        $response->assertOk()
            ->assertSee($doc->title)
            ->assertSee($page->title)
            ->assertSee('Welcome to this docs page');
    }
}
