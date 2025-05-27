<?php

namespace App\Notifications;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VideoCreatedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('A new video has been created!')
            ->line('Title: ' . $this->video->title)
            ->line('Description: ' . $this->video->description)
            ->action('View Video', route('video.show', $this->video->id));
    }

    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
