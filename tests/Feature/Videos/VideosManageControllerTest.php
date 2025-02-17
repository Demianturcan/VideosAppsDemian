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
        UserHelpers::define_gates();
    }
    #[test] public function user_with_permissions_can_manage_videos(): void
    {

    }
    #[test] public function regular_users_cannot_manage_videos(): void
    {

    }
    #[test] public function guest_users_cannot_manage_videos(): void
    {

    }
    #[test] public function superadmins_can_manage_videos(): void
    {

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
