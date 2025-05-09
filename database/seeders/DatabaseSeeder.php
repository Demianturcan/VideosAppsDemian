<?php

namespace Database\Seeders;

use App\Helpers\SerieHelpers;
use App\Helpers\UserHelpers;
use App\Helpers\VideoHelpers;
use App\Models\Serie;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Video;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->withPersonalTeam()->create();
/*
        User::factory()->withPersonalTeam()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

*/

      if (!Permission::where('name', 'manage videos')->exists()) {
           UserHelpers::create_permissions();
     }

        if (!User::where('email', config('users.default.email'))->exists()) {
            UserHelpers::createDefaultUser();
        }

        if (!User::where('email', config('users.default.teacher_email'))->exists()) {
            UserHelpers::createDefaultTeacher();
        }

        if (!User::where('email', 'superadmin@videosapp.com')->exists()) {
            UserHelpers::create_superadmin_user();
        }

        if (!User::where('email', 'regularuser@videosapp.com')->exists()) {
            UserHelpers::create_regular_user();
        }

        if (!User::where('email', 'videomanager@videosapp.com')->exists()) {
            UserHelpers::create_video_manager_user();
        }

        if (!Serie::where('title', 'Series 1')->exists() && !Serie::where('title', 'Series 2')->exists() && !Serie::where('title', 'Series 3')->exists()) {
            SerieHelpers::create_series();
        }

        if (!Video::where('title', config('videos.default.title'))->exists()) {
            VideoHelpers::createDefaultVideo();
        }

        if (!Video::where('title', config('videos.default2.title'))->exists()) {
            VideoHelpers::createDefaultVideo2();
        }

        if (!Video::where('title', config('videos.default3.title'))->exists()) {
            VideoHelpers::createDefaultVideo3();
        }

        if (!Video::where('title', config('videos.default4.title'))->exists()) {
            VideoHelpers::createDefaultVideo4();
        }
        /*
        UserHelpers::create_permissions();
        UserHelpers::createDefaultUser();
        UserHelpers::createDefaultTeacher();

        UserHelpers::create_superadmin_user();
        UserHelpers::create_regular_user();
        UserHelpers::create_video_manager_user();

        VideoHelpers::createDefaultVideo();
        VideoHelpers::createDefaultVideo2();
        VideoHelpers::createDefaultVideo3();
        VideoHelpers::createDefaultVideo4();
*/
    }
}
