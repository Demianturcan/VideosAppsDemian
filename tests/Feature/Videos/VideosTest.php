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
        $response->assertViewIs('videos.index');
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
        $user = User::where('email', 'regularuser@videosapp.com')->first() ?? UserHelpers::create_regular_user();
        $this->actingAs($user);
    }
}

