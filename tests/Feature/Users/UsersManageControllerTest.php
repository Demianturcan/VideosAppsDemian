<?php


namespace Tests\Feature\Users;

use App\Helpers\UserHelpers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UsersManageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        UserHelpers::define_gates();
    }
    #[test] public function user_with_permissions_can_see_add_users(): void
    {
        $this->loginAsSuperAdmin();
        $response = $this->get('/users/create');
        $response->assertStatus(200);
    }
    #[test] public function user_without_users_manage_create_cannot_see_add_users(): void
    {
        $this->loginAsRegularUser();
        $response = $this->get('/users/create');
        $response->assertStatus(403);
    }
    #[test] public function user_with_permissions_can_store_users(): void
    {
        $this->loginAsSuperAdmin();
        $response = $this->post('/users/store', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('users.manage'));
        $response->assertSessionHas('success', 'User created successfully.');
    }
    #[test] public function user_without_permissions_cannot_store_users(): void
    {
        $this->loginAsRegularUser();
        $response = $this->post('/users/store', [
            'name' => 'Test User',
            'email' => 'testuser@example.com',
            'password' => 'password',
        ]);
        $response->assertStatus(403);
    }
    #[test] public function user_with_permissions_can_destroy_users(): void
    {
        $this->loginAsSuperAdmin();
        $user = User::factory()->create();
        $response = $this->delete("/users/{$user->id}/destroy");

        $response->assertStatus(302);
        $response->assertRedirect(route('users.manage'));
        $response->assertSessionHas('success', 'User deleted successfully.');
    }
    #[test] public function user_without_permissions_cannot_destroy_users(): void
    {
        $this->loginAsRegularUser();
        $user = User::factory()->create();
        $response = $this->delete("/users/{$user->id}/destroy");
        $response->assertStatus(403);
    }
    #[test] public function user_with_permissions_can_see_edit_users(): void
    {
        $this->loginAsSuperAdmin();
        $user = User::factory()->create();
        $response = $this->get("/users/{$user->id}/edit");
        $response->assertStatus(200);
    }
    #[test] public function user_without_permissions_cannot_see_edit_users(): void
    {
        $this->loginAsRegularUser();
        $user = User::factory()->create();
        $response = $this->get("/users/{$user->id}/edit");
        $response->assertStatus(403);
    }
    #[test] public function user_with_permissions_can_update_users(): void
    {
        $this->loginAsSuperAdmin();
        $user = User::factory()->create();
        $response = $this->put("/users/{$user->id}", [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('users.manage'));
        $response->assertSessionHas('success', 'User updated successfully.');

        $user->refresh();
        $this->assertEquals('Updated Name', $user->name);
        $this->assertEquals('updated@example.com', $user->email);
    }
    #[test] public function user_without_permissions_cannot_update_users(): void
    {
        $this->loginAsRegularUser();
        $user = User::factory()->create();
        $response = $this->put("/users/{$user->id}", [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ]);
        $response->assertStatus(403);
    }
    #[test] public function user_with_permissions_can_manage_users(): void
    {
        $this->loginAsSuperAdmin();
        $response = $this->get('/users/manage');
        $response->assertStatus(200);
    }
    #[test] public function regular_users_cannot_manage_users(): void
    {
        $this->loginAsRegularUser();
        $response = $this->get('/users/manage');
        $response->assertStatus(403);
    }
    #[test] public function guest_users_cannot_manage_users(): void
    {
        $response = $this->get('/users/manage');
        $response->assertStatus(302);
    }
    #[test] public function superadmins_can_manage_users(): void
    {
        $this->loginAsSuperAdmin();
        $response = $this->get('/users/manage');
        $response->assertStatus(200);
    }




    public function loginAsVideoManager (): void
    {
        $user = User::where('email', 'videomanager@videosapp.com') -> first() ?? UserHelpers::create_video_manager_user();
        $this -> actingAs($user);
    }

    private function loginAsSuperAdmin(): void
    {
        $user = User::where('email', 'superadmin@videosapp.com')->first() ?? UserHelpers::create_superadmin_user();
        $this->actingAs($user);
    }

    private function loginAsRegularUser(): void
    {
        $user = User::where('email', 'regularuser@videosapp.com')->first() ?? UserHelpers::create_regular_user();
        $this->actingAs($user);
    }
}
