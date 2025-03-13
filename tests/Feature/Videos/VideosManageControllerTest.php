<?php

namespace Tests\Feature\Videos;

use App\Helpers\UserHelpers;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    #[test] public function user_with_permissions_can_access_videos_manage_route(): void
    {
        // Iniciar sessió com a usuari amb permisos per gestionar vídeos
        $this->loginAsVideoManager();

        // Fer una sol·licitud GET a la ruta /videosmanage
        $response = $this->get('/videos/manage');

        // Comprovar que la resposta és exitosa (codi d'estat 200)
        $response ->assertStatus(200);
    }
    #[test] public function user_with_permissions_can_manage_videos(): void
    {
        $this->loginAsVideoManager();

        // Attempt to access the video management route
        $response = $this->get('/videos/manage');

        // Assert that the response status is 200 OK
        $response->assertStatus(200);


    }
    #[test] public function regular_users_cannot_manage_videos(): void
    {
        // Log in as a regular user
        $this->loginAsRegularUser();

        // Attempt to access the video management route
        $response = $this->get('/videos/manage');

        // Assert that the response status is 403 Forbidden
        $response->assertStatus(403);
    }
    #[test] public function guest_users_cannot_manage_videos(): void
    {
        // Attempt to access the video management route without logging in
        $response = $this->get('/videos/manage');

        // Assert that the response status is 403 Forbidden
        $response->assertStatus(403);
    }
    #[test] public function superadmins_can_manage_videos(): void
    {
        $this->loginAsSuperAdmin();

        // Attempt to access the video management route
        $response = $this->get('/videos/manage');

        // Assert that the response status is 200 OK
        $response->assertStatus(200);
    }
    private function loginAsVideoManager(): void
    {
        $user = UserHelpers::create_video_manager_user();
        $this->actingAs($user);
    }
    private function loginAsSuperAdmin(): void
    {
        $user = UserHelpers::create_superadmin_user();
        $this->actingAs($user);
    }
    private function loginAsRegularUser(): void
    {
        $user = UserHelpers::create_regular_user();
        $this->actingAs($user);
    }
}
