<?php


namespace Tests\Feature\Series;

use App\Helpers\UserHelpers;
use App\Models\Serie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SeriesManageControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        UserHelpers::define_gates();
    }
    #[test]
    public function test_user_with_permissions_can_see_add_series(): void
    {
        $this->loginAsSuperAdmin();
        $response = $this->get('/series/create');
        $response->assertStatus(200);
    }
//     Comentat per canvi de logica en els sprints posteriors
//    #[test]
//    public function user_without_series_manage_create_cannot_see_add_series(): void
//    {
//        $this->loginAsRegularUser();
//        $response = $this->get('/series/create');
//
//        $response->assertStatus(403);
//    }
    #[test]
    public function user_with_permissions_can_store_series(): void
    {
        $this->loginAsSuperAdmin();
        $response = $this->post('/series/store', [
            'title' => 'Test Series',
            'description' => 'Test Description',
            'image' => 'https://miro.medium.com/v2/resize:fit:1400/0*AS978n4BHNj52lx8',
            'previous_url' => route('series')
        ]);

        $response->assertRedirect(route('series'));
        $this->assertDatabaseHas('series', ['title' => 'Test Series']);
    }
//  Comentat per canvi de logica en els sprints posteriors
//    #[test]
//    public function user_without_permissions_cannot_store_series(): void
//    {
//        $this->loginAsRegularUser();
//        $response = $this->post('/series', [
//            'title' => 'Test Series',
//            'description' => 'Test Description',
//            'image' => 'test.jpg',
//        ]);
//
//        $response->assertStatus(403);
//        $this->assertDatabaseMissing('series', ['title' => 'Test Series']);
//    }
    #[test]
    public function user_with_permissions_can_destroy_series(): void
    {
        $this->loginAsSuperAdmin();

        $serie = Serie::first();

        $this->get('/series/' . $serie->id . '/delete');

        $this->delete('/series/' . $serie->id . '/destroy');
        $this->assertDatabaseMissing('series', ['id' => $serie->id]);
    }
    #[test]
    public function user_without_permissions_cannot_destroy_series(): void
    {
        $admin = User::where('email', 'superadmin@videosapp.com')->first() ?? UserHelpers::create_superadmin_user();

        $serie = Serie::create([
            'title' => 'Admin Series',
            'description' => 'Series owned by admin',
            'image' => 'http://example.com/image.jpg',
            'user_id' => $admin->id,
            'user_name' => $admin->name,
            'user_photo_url' => $admin->profile_photo_url,
            'published_at' => now()
        ]);

        $this->loginAsRegularUser();

        $response = $this->delete('/series/' . $serie->id . '/destroy');

        $response->assertStatus(302);
        $response->assertRedirect(route('series'));

        $this->assertDatabaseHas('series', ['id' => $serie->id]);
    }
    #[test]
    public function user_with_permissions_can_see_edit_series(): void
    {
        $this->loginAsSuperAdmin();
        $serie = Serie::first();
        $response = $this->get('/series/' . $serie->id . '/edit');

        $response->assertStatus(200);
    }
    #[test]
    public function user_without_permissions_cannot_see_edit_series(): void
    {
        $this->loginAsRegularUser();
        $serie = Serie::first();
        $response = $this->get('/series/' . $serie->id . '/edit');

        $response->assertStatus(403);
    }
    #[test]
    public function user_with_permissions_can_update_series(): void
    {
        $this->loginAsSuperAdmin();
        $serie = Serie::first();
        $response = $this->put('/series/' . $serie->id, [
            'title' => 'Updated Series',
            'description' => 'Updated Description',
            'image' => 'updated.jpg',
            'previous_url' => route('series.manage')
        ]);

        $response->assertRedirect(route('series.manage'));
        $this->assertDatabaseHas('series', ['id' => $serie->id, 'title' => 'Updated Series']);
    }
    #[test]
    public function user_without_permissions_cannot_update_series(): void
    {
        $admin = User::where('email', 'superadmin@videosapp.com')->first() ?? UserHelpers::create_superadmin_user();

        $serie = Serie::create([
            'title' => 'Admin Series',
            'description' => 'Series owned by admin',
            'image' => 'http://example.com/image.jpg',
            'user_id' => $admin->id,
            'user_name' => $admin->name,
            'user_photo_url' => $admin->profile_photo_url,
            'published_at' => now()
        ]);

        $this->loginAsRegularUser();

        $response = $this->put('/series/' . $serie->id, [
            'title' => 'Updated Series',
            'description' => 'Updated Description',
            'image' => 'updated.jpg',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('series'));

        $this->assertDatabaseMissing('series', ['title' => 'Updated Series']);
    }
    #[test]
    public function user_with_permissions_can_manage_series(): void
    {
        $this->loginAsSuperAdmin();
        $response = $this->get('/series/manage');
        $response->assertStatus(200);
    }
    #[test]
    public function regular_users_cannot_manage_series(): void
    {
        $this->loginAsRegularUser();
        $response = $this->get('/series/manage');
        $response->assertStatus(403);
    }
    #[test]
    public function guest_users_cannot_manage_series(): void
    {
        $response = $this->get('/series/manage');
        $response->assertRedirect('/login');
    }
    #[test]
    public function videomanagers_can_manage_series(): void
    {
        $this->loginAsVideoManager();
        $response = $this->get('/series/manage');
        $response->assertStatus(200);
    }
    #[test]
    public function superadmins_can_manage_series(): void
    {
        $this->loginAsSuperAdmin();
        $response = $this->get('/series/manage');
        $response->assertStatus(200);
    }
    public function loginAsVideoManager(): void
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
