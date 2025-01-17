<?php

namespace App\Helpers;

use App\Models\Video;
use Carbon\Carbon;

class VideoHelpers
{
    public static function createDefaultVideo()
    {
        return Video::create([
            'title' => 'Default Video Title',
            'description' => 'Default Video Description',
            'url' => 'https://example.com/default-video',
            'published_at' => Carbon::now(),
            'previous' => null,
            'next' => null,
            'series_id' => 1,
        ]);
    }
}


