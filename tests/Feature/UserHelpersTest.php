<?php

namespace Tests\Feature;

use App\Helpers\UserHelpers;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserHelpersTest extends TestCase
{
    use RefreshDatabase;


    #[test] public function create_default_user_and_teacher()
    {
        // Arrange
        $defaultUserName = config('users.default.name');
        $defaultUserEmail = config('users.default.email');
        $defaultTeacherName = config('users.default.teacher_name');
        $defaultTeacherEmail = config('users.default.teacher_email');
        $defaultTeamName = config('users.default.team_name');
        $defaultTeacherTeamName = config('users.default.teacher_team_name');

        // Act
        $user = UserHelpers::createDefaultUser();
        $teacher = UserHelpers::createDefaultTeacher();

        // Assert
        // Comprovar que existeix l'usuari per nom i correu
        $this->assertDatabaseHas('users', [
            'name' => $defaultUserName,
            'email' => $defaultUserEmail,
        ]);
        $this->assertTrue(Hash::check(config('users.default.password'), $user->password));

        // Comprovar que existeix el professor per nom i correu
        $this->assertDatabaseHas('users', [
            'name' => $defaultTeacherName,
            'email' => $defaultTeacherEmail,
        ]);
        $this->assertTrue(Hash::check(config('users.default.teacher_password'), $teacher->password));

        // Comprovar que l'usuari està associat al seu equip
        $this->assertDatabaseHas('teams', [
            'name' => $defaultTeamName,
        ]);
        $this->assertDatabaseHas('teams', [
            'name' => $defaultTeacherTeamName,
        ]);

        $this->assertTrue($user->teams->contains('name', $defaultTeamName));
        $this->assertTrue($teacher->teams->contains('name', $defaultTeacherTeamName));
    }
}
