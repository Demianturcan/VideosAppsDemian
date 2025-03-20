<?php

namespace Tests\Feature\Videos;

use App\Helpers\UserHelpers;
use App\Helpers\VideoHelpers;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        UserHelpers::define_gates();
    }

    #[test] public function user_with_permissions_can_access_videos_manage_route(): void
    {
        // Iniciar sessió com a usuari amb permisos per gestionar vídeos
        $this->loginAsVideoManager();

        // Fer una sol·licitud GET a la ruta /videosmanage
        $response = $this->get('/video/manage');

        // Comprovar que la resposta és exitosa (codi d'estat 200)
        $response ->assertStatus(200);
    }
    #[test] public function user_with_permissions_can_manage_videos(): void
    {
        $this->loginAsVideoManager();

        $videos = Video::all();
        // Attempt to access the video management route
        $response = $this->get('/video/manage');

        // Assert that the response status is 200 OK
        $response->assertStatus(200);

        // Assert that the videos are displayed on the page
        foreach ($videos as $video) {
            $response->assertSee($video->title);
        }
    }
    #[test] public function regular_users_cannot_manage_videos(): void
    {
        // Log in as a regular user
        $this->loginAsRegularUser();

        // Attempt to access the video management route
        $response = $this->get('/video/manage');

        // Assert that the response status is 403 Forbidden
        $response->assertStatus(403);
    }
    #[test] public function guest_users_cannot_manage_videos(): void
    {
        // Attempt to access the video management route without logging in
        $response = $this->get('/video/manage');

        $response->assertStatus(302);
    }
    #[test] public function superadmins_can_manage_videos(): void
    {
        $this->loginAsSuperAdmin();

        // Attempt to access the video management route
        $response = $this->get('/video/manage');

        // Assert that the response status is 200 OK
        $response->assertStatus(200);
    }
    #[test] public function user_with_permissions_can_see_add_videos(): void
    {
        $this->loginAsVideoManager();
        $response = $this->get('/video/create');
        $response->assertStatus(200);
    }

    #[test] public function user_without_videos_manage_create_cannot_see_add_videos(): void
    {
        $this->loginAsRegularUser();
        $response = $this->get('/video/create');
        $response->assertStatus(403);
    }

    #[test] public function user_with_permissions_can_store_videos(): void
    {
        $this->loginAsVideoManager();
        $response = $this->post('/videos/store', [
            'title' => 'Test Video',
            'description' => 'Test Description',
            'url' => 'http://example.com/video.mp4',
            'series_id'=>1,
        ]);
        $response->assertRedirect(route('videos.manage'));

        // Verify that the video was created
        $this->assertDatabaseHas('videos', [
            'title' => 'Test Video',
            'description' => 'Test Description',
            'url' => 'http://example.com/video.mp4',
            'series_id' => 1,
        ]);
    }

    #[test] public function user_without_permissions_cannot_store_videos(): void
    {
        $this->loginAsRegularUser();
        $response = $this->post('/videos/store', [
            'title' => 'Test Video',
            'description' => 'Test Description',
            'url' => 'http://example.com/video.mp4',
            'series_id'=>1,
        ]);
        $response->assertStatus(403);
    }

    #[test] public function user_with_permissions_can_destroy_videos(): void
    {
        $this->loginAsVideoManager();
        $video = Video::first();
        $response = $this->delete("/videos/{$video->id}/destroy");

        $response->assertRedirect(route('videos.manage'));

        $this->assertDatabaseMissing('videos', ['id' => $video->id]);
    }

    #[test] public function user_without_permissions_cannot_destroy_videos(): void
    {
        $this->loginAsRegularUser();
        $video = Video::first();
        $response = $this->delete("/videos/{$video->id}/destroy");
        $response->assertStatus(403);
    }

    #[test] public function user_with_permissions_can_see_edit_videos(): void
    {
        $this->loginAsVideoManager();
        $video = Video::first();
        $response = $this->get("/videos/{$video->id}/edit");
        $response->assertStatus(200);
    }

    #[test] public function user_without_permissions_cannot_see_edit_videos(): void
    {
        $this->loginAsRegularUser();
        $video = Video::first();
        $response = $this->get("/videos/{$video->id}/edit");
        $response->assertStatus(403);
    }

    #[test] public function user_with_permissions_can_update_videos(): void
    {
        $this->loginAsVideoManager();
        $video = Video::first();
        $response = $this->put("/videos/{$video->id}", [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'url' => 'http://example.com/updated_video.mp4',
            'series_id' => 1,
        ]);
        $response->assertRedirect(route('videos.manage'));

        $this->assertDatabaseHas('videos', [
            'id' => $video->id,
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'url' => 'http://example.com/updated_video.mp4',
            'series_id' => 1,
        ]);
    }

    #[test] public function user_without_permissions_cannot_update_videos(): void
    {
        $this->loginAsRegularUser();
        $video = Video::first();
        $response = $this->put("/videos/{$video->id}", [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'url' => 'http://example.com/updated_video.mp4',
        ]);
        $response->assertStatus(403);
    }


    private function loginAsVideoManager(): void
    {
        $user = User::where('email', 'videomanager@videosapp.com')->first() ?? UserHelpers::create_video_manager_user();
        $this->actingAs($user);
    }

    private function loginAsSuperAdmin(): void
    {
        $user = User::where('email', 'superadmin@videosapp.com')->first() ?? UserHelpers::create_superadmin_user();
        $this->actingAs($user);
    }

    private function loginAsRegularUser(): void
    {
        $user = User::where('email', 'regular@videosapp.com')->first() ?? UserHelpers::create_regular_user();
        $this->actingAs($user);
    }
}
