<?php


namespace Tests\Feature\Videos;

use App\Events\VideoCreated;
use App\Helpers\UserHelpers;
use App\Models\User;
use App\Models\Video;
use App\Notifications\VideoCreatedNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class VideoNotificationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
        UserHelpers::define_gates();
    }

    #[Test]
    public function test_video_created_event_is_dispatched()
    {
        Event::fake([VideoCreated::class]);
        $this->loginAsVideoManager();

        $response = $this->post('/videos/store', [
            'title' => 'Test Notification Video',
            'description' => 'Testing notification system',
            'url' => 'http://example.com/video.mp4',
        ]);
        Event::assertDispatched(VideoCreated::class, function ($event) {
            return $event->video->title === 'Test Notification Video';
        });
    }
    #[Test]
    public function test_push_notification_is_sent_when_video_is_created()
    {
        Notification::fake();
        $admins = User::where('super_admin', true)->get();

        $this->loginAsVideoManager();

        $response = $this->post('/videos/store', [
            'title' => 'Notification Test Video',
            'description' => 'This should trigger a notification',
            'url' => 'http://example.com/notification-test.mp4',
        ]);

        $video = Video::where('title', 'Notification Test Video')->first();

        Notification::assertSentTo(
            $admins,
            VideoCreatedNotification::class,
            function ($notification, $channels, $notifiable) use ($video) {
                return $notification->video->id === $video->id;
            }
        );
    }

    private function loginAsVideoManager(): User
    {
        $user = User::where('email', 'videomanager@videosapp.com')->first()
            ?? UserHelpers::create_video_manager_user();
        $this->actingAs($user);
        return $user;
    }

    private function loginAsSuperAdmin(): User
    {
        $user = User::where('email', 'superadmin@videosapp.com')->first()
            ?? UserHelpers::create_superadmin_user();
        $this->actingAs($user);
        return $user;
    }
}
