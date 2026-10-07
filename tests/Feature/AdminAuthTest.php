<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_admin_login()
    {
        $response = $this->get('/admin/dashboard');

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_login_page()
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('LEGIT CHEMICAL');
    }

    public function test_admin_can_login_with_valid_credentials()
    {
        $admin = Admin::create([
            'name' => 'Admin Test',
            'username' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('Admin123!'),
        ]);

        $response = $this->post('/admin/login', [
            'login' => 'admin',
            'password' => 'Admin123!',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_admin_cannot_login_with_invalid_password()
    {
        Admin::create([
            'name' => 'Admin Test',
            'username' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('Admin123!'),
        ]);

        $response = $this->post('/admin/login', [
            'login' => 'admin',
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors('login');
        $this->assertGuest('admin');
    }
}
