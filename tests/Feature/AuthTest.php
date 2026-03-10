<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/login');
    }

    public function test_login_page_is_accessible(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
    }

    public function test_admin_can_login(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@meem.com.my',
            'password' => bcrypt('12345678'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@meem.com.my',
            'password' => '12345678',
        ]);

        $response->assertRedirect('/dashboard');
        $this->assertAuthenticatedAs($user);
    }

    public function test_invalid_credentials_rejected(): void
    {
        User::factory()->create(['email' => 'admin@meem.com.my', 'password' => bcrypt('12345678')]);

        $response = $this->post('/login', [
            'email' => 'admin@meem.com.my',
            'password' => 'wrongpassword',
        ]);

        $this->assertGuest();
    }

    public function test_authenticated_user_can_access_dashboard(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    public function test_root_redirects_to_dashboard(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/');
        $response->assertRedirect();
    }
}
