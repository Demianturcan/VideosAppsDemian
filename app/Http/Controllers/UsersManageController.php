<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class UsersManageController extends Controller
{
    public function index(): View
    {
        $users = User::all();
        return view('users.manage.index', ['users' => $users]);
    }

    public function create(): View
    {
        return view('users.manage.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        User::create($validated);

        return redirect()->route('users.manage')->with('success', 'User created successfully.');
    }

    public function edit(User $user): View
    {
        return view('users.manage.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.manage')->with('success', 'User updated successfully.');
    }

    public function delete(User $user): View
    {
        return view('users.manage.delete', compact('user'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('users.manage')->with('success', 'User deleted successfully.');
    }

    public function tested_by(User $user): View
    {
        $testedBy = User::where('tested_by', $user->id)->get();
        return view('users.tested_by', compact('testedBy'));
    }
}
