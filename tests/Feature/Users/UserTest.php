<?php

namespace Tests\Feature\Users;

use App\Helpers\UserHelpers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        UserHelpers::define_gates();
    }

    #[test] public function user_without_permissions_can_see_default_users_page(): void
    {
        $this->loginAsRegularUser();
        $response = $this->get('/users');
        $response->assertStatus(200);
    }

    #[test] public function user_with_permissions_can_see_default_users_page(): void
    {
        $this->loginAsSuperAdmin();
        $response = $this->get('/users');
        $response->assertStatus(200);
    }

//    #[test] public function not_logged_users_cannot_see_default_users_page(): void
//    {
//        $response = $this->get('/users');
//        $response->assertStatus(302);
//    }

    #[test] public function user_without_permissions_can_see_user_show_page(): void
    {
        $this->loginAsRegularUser();
        $user = User::first();
        $response = $this->get("/user/{$user->id}");
        $response->assertStatus(200);
    }

    #[test] public function user_with_permissions_can_see_user_show_page(): void
    {
        $this->loginAsSuperAdmin();
        $user = User::first();
        $response = $this->get("/user/{$user->id}");
        $response->assertStatus(200);
    }

//    #[test] public function not_logged_users_cannot_see_user_show_page(): void
//    {
//        $user = User::first();
//        $response = $this->get("/user/{$user->id}");
//        $response->assertStatus(302);
//    }

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
