<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_users_are_redirected_from_login_to_docs(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('login'))
            ->assertRedirect(route('docs'));
    }

    public function test_authenticated_users_are_redirected_from_register_to_docs(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('register'))
            ->assertRedirect(route('docs'));
    }

    public function test_authenticated_users_are_redirected_from_landing_page_to_docs(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('welcome'))
            ->assertRedirect(route('docs'));
    }

    public function test_authenticated_users_can_access_docs(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('docs'))
            ->assertOk();
    }
}
