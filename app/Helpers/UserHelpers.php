<?php

namespace App\Helpers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserHelpers
{
    public static function createDefaultUser()
    {
        // Crea un nou equip
        $team = Team::create([
            'name' => config('users.default.team_name'),
            'personal_team' => true, // o false, depenent de com ho vulguis configurar
        ]);

        // Crea l'usuari i l'associa a l'equip creat
        $user = User::create([
            'name' => config('users.default.name'),
            'email' => config('users.default.email'),
            'password' => Hash::make(config('users.default.password')),
        ]);

        $user->teams()->attach($team);

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
        ]);

        $teacher->teams()->attach($team);

        return $teacher;
    }
}
