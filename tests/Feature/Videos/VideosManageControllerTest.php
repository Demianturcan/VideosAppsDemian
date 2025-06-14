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
        $response = $this->get('/video/manage');

        $response->assertStatus(200);

        foreach ($videos as $video) {
            $response->assertSee($video->title);
        }
    }
    #[test] public function regular_users_cannot_manage_videos(): void
    {
        $this->loginAsRegularUser();

        $response = $this->get('/video/manage');

        $response->assertStatus(403);
    }
    #[test] public function guest_users_cannot_manage_videos(): void
    {
        $response = $this->get('/video/manage');

        $response->assertStatus(302);
    }
    #[test] public function superadmins_can_manage_videos(): void
    {
        $this->loginAsSuperAdmin();

        $response = $this->get('/video/manage');

        $response->assertStatus(200);
    }
    #[test] public function user_with_permissions_can_see_add_videos(): void
    {
        $this->loginAsVideoManager();
        $response = $this->get('/video/create');
        $response->assertStatus(200);
    }

//    #[test] public function user_without_videos_manage_create_cannot_see_add_videos(): void
//    {
//        $this->loginAsRegularUser();
//        $response = $this->get('/video/create');
//        $response->assertStatus(403);
//    }

    #[test] public function user_with_permissions_can_store_videos(): void
    {
        $user = $this->loginAsVideoManager();

        $response = $this->post('/videos/store', [
            'title' => 'Test Video',
            'description' => 'Test Description',
            'url' => 'http://example.com/video.mp4',
            'series_id' => 1,
            'user_id' => $user->id,
            'previous_url' => route('videos.manage'),
        ]);
        $response->assertRedirect(route('videos.manage'));

        // Verify that the video was created
        $this->assertDatabaseHas('videos', [
            'title' => 'Test Video',
            'description' => 'Test Description',
            'url' => 'http://example.com/video.mp4',
            'user_id'=>$user->id,
        ]);

        $user = $this->loginAsSuperAdmin();

        $response = $this->post('/videos/store', [
            'title' => 'Test Video 2',
            'description' => 'Test Description',
            'url' => 'http://example.com/video.mp4',
            'series_id' => 1,
            'user_id' => $user->id,
            'previous_url' => route('videos.manage'),
        ]);
        $response->assertRedirect(route('videos.manage'));

        // Verify that the video was created
        $this->assertDatabaseHas('videos', [
            'title' => 'Test Video 2',
            'description' => 'Test Description',
            'url' => 'http://example.com/video.mp4',
            'user_id'=>$user->id,
        ]);

    }

//    #[test] public function user_without_permissions_cannot_store_videos(): void
//    {
//        $this->loginAsRegularUser();
//        $response = $this->post('/videos/store', [
//            'title' => 'Test Video',
//            'description' => 'Test Description',
//            'url' => 'http://example.com/video.mp4',
//            'series_id'=>1,
//        ]);
//        $response->assertStatus(403);
//    }

    #[test] public function user_with_permissions_can_destroy_videos(): void
    {
        $this->loginAsVideoManager();
        $video = Video::first();
        $response = $this->delete("/videos/{$video->id}/destroy", [
            'previous_url' => route('videos.manage')
        ]);

        $response->assertRedirect(route('videos'));

        $this->assertDatabaseMissing('videos', ['id' => $video->id]);
    }

    #[test] public function user_without_permissions_cannot_destroy_videos(): void
    {
        // Crear un usuari super admin el qual serà propietari del vídeo
        $admin = $this->loginAsSuperAdmin();

        //Crear un vídeo propietat de l'admin
        $video = Video::create([
            'title' => 'Admin Video',
            'description' => 'Video owned by admin',
            'url' => 'http://example.com/admin-video.mp4',
            'user_id' => $admin->id,
            'published_at' => now()
        ]);
        // Iniciar sessió com a usuari normal
        $this->loginAsRegularUser();

        // Intentar eliminar el vídeo
        $response = $this->delete("/videos/{$video->id}/destroy");

        $response->assertStatus(302);
        $response->assertRedirect(route('videos'));
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
        // Crear un usuari super admin el qual serà propietari del vídeo
        $admin = $this->loginAsSuperAdmin();

        // Crear un vídeo propietat de l'admin
        $video = Video::create([
            'title' => 'Admin Video',
            'description' => 'Video owned by admin',
            'url' => 'http://example.com/admin-video.mp4',
            'user_id' => $admin->id,
            'published_at' => now()
        ]);
        // Iniciar sessió com a usuari normal
        $this->loginAsRegularUser();

        $response = $this->put("/videos/{$video->id}", [
            'title' => 'Updated Title',
            'description' => 'Updated Description',
            'url' => 'http://example.com/updated_video.mp4',
        ]);

        // Comprovar que la resposta és un redireccionament
        $response->assertStatus(302);
        $response->assertRedirect(route('videos'));
    }


    private function loginAsVideoManager(): User
    {
        $user = User::where('email', 'videomanager@videosapp.com')->first() ?? UserHelpers::create_video_manager_user();
        $this->actingAs($user);
        return $user;
    }

    private function loginAsSuperAdmin()
    {
        $user = User::where('email', 'superadmin@videosapp.com')->first() ?? UserHelpers::create_superadmin_user();
        $this->actingAs($user);
        return $user;
    }

    private function loginAsRegularUser()
    {
        $user = User::where('email', 'regularuser@videosapp.com')->first() ?? UserHelpers::create_regular_user();
        $this->actingAs($user);
        return $user;
    }
}
