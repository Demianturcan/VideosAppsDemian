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
            'url' => 'https://www.youtube.com/embed/eLI8c_NtkBk',
            'published_at' => Carbon::parse('2023-12-25'),
            'previous' => null,
            'next' => null,
            'series_id' => 1,
        ]);
    }
}


