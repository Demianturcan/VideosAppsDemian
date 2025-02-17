<?php

namespace App\Helpers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserHelpers
{
    public static function createDefaultUser()
    {

        $user = User::create([
            'name' => config('users.default.name'),
            'email' => config('users.default.email'),
            'password' => Hash::make(config('users.default.password')),
        ]);

        $team = Team::create([
            'name' => config('users.default.team_name'),
            'personal_team' => true,
        ]);

        $user->teams()->attach($team->id);
        session(['team_id' => $team->id]);

        return $user;
    }

    public static function createDefaultTeacher()
    {
        // Crea un nou equip
        $team = Team::create([
            'name' => config('users.default.teacher_team_name'),
            'personal_team' => true,
        ]);

        // Crea l'usuari professor i l'associa a l'equip creat
        $teacher = User::create([
            'name' => config('users.default.teacher_name'),
            'email' => config('users.default.teacher_email'),
            'password' => Hash::make(config('users.default.teacher_password')),
            'super_admin' => true,
        ]);

        $teacher->teams()->attach($team);

        return $teacher;
    }


    public static function add_personal_team(User $user): void
    {
        $team = Team::create([
            'name' => $user->name . "'s Team",
            'personal_team' => true,
        ]);
        $user->teams()->attach($team->id);
    }

    public static function create_regular_user()
    {
        $user = User::create([
            'name' => 'regular',
            'email' => 'regular@videosapp.com',
            'password' => Hash::make('123456789'),
        ]);
        self::add_personal_team($user);
        $team = $user->teams()->first();
        session(['team_id' => $team->id]);
        return $user;
    }

    public static function create_video_manager_user()
    {
        $user = User::create([
            'name' => 'Video Manager',
            'email' => 'videomanager@example.com',
            'password' => Hash::make('123456789'),
        ]);
        self::add_personal_team($user);
        $team = $user->teams()->first();
        session(['team_id' => $team->id]);
        return $user;
    }

    public static function create_superadmin_user()
    {
        return User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@videosapp.com',
            'password' => Hash::make('123456789'),
            'super_admin' => true,
        ]);
    }

    public static function define_gates(): void
    {
        Gate::define('manage-videos', function ($user, $teamId) {
            return $user->hasPermissionTo('manage videos', $teamId);
        });

        Gate::define('super-admin', function ($user) {
            return $user->hasRole('super admin');
        });
    }

    public static function create_permissions(): void
    {
        Permission::create(['name' => 'manage videos']);
        Permission::create(['name' => 'super admin']);
    }

}
















