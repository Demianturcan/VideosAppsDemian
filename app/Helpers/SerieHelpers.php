<?php

namespace App\Helpers;

use App\Models\Serie;
use App\Models\User;
use Carbon\Carbon;

class SerieHelpers
{
    public static function create_series()
    {
        $user1 = User::where('email', config('users.default.email'))->first();
        $userName1 = $user1 ? $user1->name : 'User 1';

        Serie::create([
            'title' => 'Series 1',
            'description' => 'Description for Series 1',
            'image' => 'https://novu.co/static/38a1ca18f76dc1639f3d3ae294c4f7b4/9585e/novu-cover-laravel-reverb-6.2.jpg',
            'user_name' => $userName1,
            'user_photo_url' => 'https://example.com/user1.jpg',
            'published_at' => Carbon::now(),
        ]);

        $user2 = User::where('email', config('users.default.teacher_email'))->first();
        $userName2 = $user2 ? $user2->name : 'User 2';

        Serie::create([
            'title' => 'Series 2',
            'description' => 'Description for Series 2',
            'image' => 'https://miro.medium.com/v2/resize:fit:1400/0*AS978n4BHNj52lx8',
            'user_name' => $userName2,
            'user_photo_url' => 'https://example.com/user2.jpg',
            'published_at' => Carbon::now(),
        ]);

        $user3 = User::where('email', 'regularuser@videosapp.com')->first();
        $userName3 = $user3 ? $user3->name : 'User 3';

        Serie::create([
            'title' => 'Series 3',
            'description' => 'Description for Series 3',
            'image' => 'https://www.etondigital.com/wp-content/uploads/2019/05/laravel-blog.png',
            'user_name' => $userName3,
            'user_photo_url' => 'https://example.com/user3.jpg',
            'published_at' => Carbon::now(),
        ]);
    }
}
