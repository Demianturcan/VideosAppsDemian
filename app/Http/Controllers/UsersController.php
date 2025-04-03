<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;

class UsersController extends Controller
{
    public function index(): View
    {

        $users = User::all();

        return view('users.index', ['users' => $users]);
    }

    public function show(User $user): View
    {
        $videos = $user->videos;
        return view('users.show', compact('user', 'videos'));
    }
    public function testedBy(int $userId): View
    {
        $users = User::where('tested_by', $userId)->get();
        return view('users.tested_by', ['users' => $users]);
    }

}


