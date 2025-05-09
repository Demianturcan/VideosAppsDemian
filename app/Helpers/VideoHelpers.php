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
//            'series_id' => 1,
            'user_id' => 1,
        ]);
    }
    public static function createDefaultVideo2()
    {
        return Video::create([
            'title' => 'Default Video Title 2',
            'description' => 'Default Video Description 2',
            'url' => 'https://www.youtube.com/embed/ysujMEWQA_I',
            'published_at' => Carbon::parse('2023-12-25'),
            'previous' => null,
            'next' => null,
//            'series_id' => 2,
            'user_id' => 4,
        ]);
    }
    public static function createDefaultVideo3()
    {
        return Video::create([
            'title' => 'Default Video Title 3',
            'description' => 'Default Video Description 3',
            'url' => 'https://www.youtube.com/embed/4Re7hZdsoOI',
            'published_at' => Carbon::parse('2023-12-25'),
            'previous' => null,
            'next' => null,
//            'series_id' => 3,
            'user_id' => 3,
        ]);
    }
    public static function createDefaultVideo4()
    {
        return Video::create([
            'title' => 'Default Video Title 4',
            'description' => 'Default Video Description 4',
            'url' => 'https://www.youtube.com/embed/ge9PpxIND4M',
            'published_at' => Carbon::parse('2023-12-25'),
            'previous' => null,
            'next' => null,
//            'series_id' => 3,
            'user_id' => 2,
        ]);
    }


}


