<?php

namespace Tests\Feature\Videos;

use App\Helpers\UserHelpers;
use App\Helpers\VideoHelpers;
use App\Models\User;
use App\Models\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class VideosTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        UserHelpers::define_gates();
    }
    /**
     * Test if users can view existing videos.
     */
    #[test] public function test_users_can_view_videos()
    {
        //Crear un vídeo
        $video = VideoHelpers::createDefaultVideo();

        //Fer una sol·licitud GET a la URL
        $response = $this->get(url('/videos/' . $video->id));

        //Comprovar que la resposta és exitosa
        $response->assertStatus(200);
        $response->assertSee($video->title);
    }

    /**
     * Prova si els usuaris no poden veure vídeos inexistents.
     */
    #[test] public function test_users_cannot_view_not_existing_videos()
    {
        $response = $this->get(url('/videos/999'));
        $response->assertStatus(404);
    }

    #[test] public function user_without_permissions_can_see_default_videos_page(): void
    {
        $this->loginAsRegularUser();
        $response = $this->get('/videos');
        $response->assertStatus(200);
    }

    #[test] public function user_with_permissions_can_see_default_videos_page(): void
    {
        // Log in as a user with video management permissions
        $this->loginAsVideoManager();
        $response = $this->get('/videos');
        $response->assertStatus(200);
    }

    #[test] public function not_logged_users_can_see_default_videos_page(): void
    {

        $response = $this->get('/videos');
        $response->assertStatus(200);
    }

    #[test] public function user_with_permissions_can_see_add_videos(): void
    {
        $this->loginAsVideoManager();
        $response = $this->get('/videos/create');
        $response->assertStatus(200);
    }

    #[test] public function user_without_videos_manage_create_cannot_see_add_videos(): void
    {
        $this->loginAsRegularUser();
        $response = $this->get('/videos/create');
        $response->assertStatus(403);
    }

    #[test] public function user_with_permissions_can_store_videos(): void
    {
        $this->loginAsVideoManager();
        $response = $this->post('/videos/store', [
            'title' => 'Test Video',
            'description' => 'Test Description',
            'url' => 'http://example.com/video.mp4',
        ]);
        $response->assertStatus(201);
    }

    #[test] public function user_without_permissions_cannot_store_videos(): void
    {
        $this->loginAsRegularUser();
        $response = $this->post('/videos/store', [
            'title' => 'Test Video',
            'description' => 'Test Description',
            'url' => 'http://example.com/video.mp4',
        ]);
        $response->assertStatus(403);
    }

    #[test] public function user_with_permissions_can_destroy_videos(): void
    {
        $this->loginAsVideoManager();
        $video = VideoHelpers::createDefaultVideo();
        $response = $this->delete("/videos/{$video->id}/destroy");
        $response->assertStatus(200);
    }

    #[test] public function user_without_permissions_cannot_destroy_videos(): void
    {
        $this->loginAsRegularUser();
        $video = VideoHelpers::createDefaultVideo();
        $response = $this->delete("/videos/{$video->id}/destroy");
        $response->assertStatus(403);
    }

    #[test] public function user_with_permissions_can_see_edit_videos(): void
    {
        $this->loginAsVideoManager();
        $video = VideoHelpers::createDefaultVideo();
        $response = $this->get("/videos/{$video->id}/edit");
        $response->assertStatus(200);
    }

    #[test] public function user_without_permissions_cannot_see_edit_videos(): void
    {
        $this->loginAsRegularUser();
        $video = VideoHelpers::createDefaultVideo();
        $response = $this->get("/videos/{$video->id}/edit");
        $response->assertStatus(403);
    }

    #[test] public function user_with_permissions_can_update_videos(): void
    {
        $this->loginAsVideoManager();
        $video = VideoHelpers::createDefaultVideo();
        $response = $this->put("/videos/{$video->id}", [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'url' => 'http://example.com/updated_video.mp4',
        ]);
        $response->assertStatus(200);
    }

    #[test] public function user_without_permissions_cannot_update_videos(): void
    {
        $this->loginAsRegularUser();
        $video = VideoHelpers::createDefaultVideo();
        $response = $this->put("/videos/{$video->id}", [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'url' => 'http://example.com/updated_video.mp4',
        ]);
        $response->assertStatus(403);
    }

    #[test] public function user_with_permissions_can_manage_videos(): void
    {
        $this->loginAsVideoManager();
        $videos = Video::factory()->count(3)->create();
        $response = $this->get('/videosmanage');
        $response->assertStatus(200);
        foreach ($videos as $video) {
            $response->assertSee($video->title);
        }
    }

    #[test] public function regular_users_cannot_manage_videos(): void
    {
        $this->loginAsRegularUser();
        $response = $this->get('/videosmanage');
        $response->assertStatus(403);
    }

    #[test] public function guest_users_cannot_manage_videos(): void
    {
        $response = $this->get('/videosmanage');
        $response->assertStatus(302);
    }

    #[test] public function superadmins_can_manage_videos(): void
    {
        $this->loginAsSuperAdmin();
        $response = $this->get('/videosmanage');
        $response->assertStatus(200);
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

