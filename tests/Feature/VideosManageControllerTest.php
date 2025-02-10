<?php

namespace Tests\Feature;

use App\Helpers\UserHelpers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class VideosManageControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    #[test] public function user_with_permissions_can_manage_videos(): void
    {
        UserHelpers::create_permissions();

        $user = UserHelpers::create_video_manager_user();
        $team = $user->teams()->first();
        $teamId = $team->id;

        $user->givePermissionTo('manage videos', $teamId);

        $response = $this->actingAs($user)->get('/videos/manage');

        $response->assertStatus(200);
    }
}
