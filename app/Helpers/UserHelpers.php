<?php

namespace App\Helpers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserHelpers
{


    public static function add_personal_team(User $user)
    {
        $team = Team::firstOrCreate(
            ['name' => $user->name . "'s Team"],
            ['personal_team' => true, 'user_id' => $user->id]
        );

        if (!$team->wasRecentlyCreated) {
            $team->user_id = $user->id;
            $team->save();
        }

        $user->teams()->syncWithoutDetaching([$team->id]);

        $user->team_id = $team->id;
        $user->save();
        return $team;
    }

    public static function createDefaultUser()
    {
        $user = User::create([
            'name' => config('users.default.name'),
            'email' => config('users.default.email'),
            'password' => Hash::make(config('users.default.password')),
        ]);

        self::add_personal_team($user);

        return $user;
    }

    public static function createDefaultTeacher()
    {
        $user = User::create([
            'name' => config('users.default.teacher_name'),
            'email' => config('users.default.teacher_email'),
            'password' => Hash::make(config('users.default.teacher_password')),
            'super_admin' => true,
        ]);

        self::add_personal_team($user);
        $user->givePermissionTo('manage videos');

        return $user;
    }

    public static function create_regular_user()
    {
        $user = User::create([
            'name' => 'RegularUser',
            'email' => 'regularuser@videosapp.com',
            'password' => Hash::make('123456789'),
        ]);

        self::add_personal_team($user);

        return $user;
    }

    public static function create_video_manager_user()
    {
        $user = User::create([
            'name' => 'Video Manager',
            'email' => 'videomanager@videosapp.com',
            'password' => Hash::make('123456789'),
        ]);

        self::add_personal_team($user);

        $user->givePermissionTo('manage videos');
        $user->givePermissionTo('manage series');
        return $user;
    }

    public static function create_superadmin_user()
    {
        $user = User::create([
            'email' => 'superadmin@videosapp.com',
            'name' => 'Super Admin',
            'password' => Hash::make('123456789'),
            'super_admin' => true,
        ]);

        self::add_personal_team($user);

        $user->assignRole('super admin');
        $user->givePermissionTo('manage videos');
        $user->givePermissionTo('manage users');
        $user->givePermissionTo('manage series');
        $user->save();

        return $user;
    }

    public static function define_gates(): void
    {
        Gate::define('manage-videos', function ($user) {
            return $user->hasPermissionTo('manage videos');
        });

        Gate::define('manage-users', function ($user) {
            return $user->hasPermissionTo('manage users');
        });
        Gate::define('manage-series', function ($user) {
            return $user->hasPermissionTo('manage series');
        });
        Gate::define('super-admin', function ($user) {
            return $user->hasRole('super admin');
        });


    }

    public static function create_permissions(): void
    {

        Permission::create(['name' => 'manage videos']);
        Permission::create(['name' => 'manage users']);
        Permission::create(['name' => 'manage series']);
        $role = Role::firstOrCreate(['name' => 'super admin']);
        $permissions = Permission::all();
        $role->syncPermissions($permissions);

    }

}

