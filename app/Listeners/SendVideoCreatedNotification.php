<?php

namespace App\Listeners;

use App\Events\VideoCreated;
use App\Models\User;
use App\Notifications\VideoCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class SendVideoCreatedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param VideoCreated $event
     * @return void
     */
    public function handle(VideoCreated $event): void
    {


        $admins = User::where('super_admin', true)->get();
        Log::info('Admin users found', ['count' => $admins->count(), 'emails' => $admins->pluck('email')]);

        Notification::send($admins, new VideoCreatedNotification($event->video));
    }
}

















