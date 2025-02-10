<?php

namespace Database\Seeders;

use App\Helpers\UserHelpers;
use App\Helpers\VideoHelpers;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        UserHelpers::createDefaultUser();
        UserHelpers::createDefaultTeacher();

        VideoHelpers::createDefaultVideo();

        UserHelpers::create_permissions();
        UserHelpers::create_superadmin_user();
        UserHelpers::create_regular_user();
        UserHelpers::create_video_manager_user();

    }
}



















