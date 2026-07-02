<?php

namespace Database\Seeders;

use App\Models\Doc;
use App\Models\Page;
use App\Models\Section;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $user = User::factory()->create([
            'first_name' => 'John',
            'middle_name' => 'Apple',
            'last_name' => 'Doe',
            'fullname' => 'John A. Doe',
            'email' => 'test@example.com',
        ]);

        $doc = Doc::factory()->create([
            'user_id' => $user->id,
            'title' => 'My Documentation',
            'description' => 'My first documentation',
            'slug' => 'my-documentation',
        ]);

        $section = Section::factory()->create([
            'doc_id' => $doc->id,
            'title' => 'Getting Started',
            'order' => 0,
        ]);

        Page::factory()->create([
            'doc_id' => $doc->id,
            'section_id' => $section->id,
            'title' => 'Welcome',
            'slug' => 'welcome',
            'content' => '',
            'order' => 0,
        ]);

        Page::factory()->create([
            'doc_id' => $doc->id,
            'section_id' => $section->id,
            'title' => 'Installation',
            'slug' => 'installation',
            'content' => '<p>Installation guide content...</p>',
            'order' => 1,
        ]);
    }
}
