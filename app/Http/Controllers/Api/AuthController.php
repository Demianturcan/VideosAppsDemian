<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class AuthController extends Controller
{
    final public function login(): JsonResponse
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        $user = User::where('email', request()->email)->first();

        if (! $user || ! Hash::check(request()->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'token' => $user->createToken(request()->device_name)->plainTextToken
        ]);
    }

    public function register(): JsonResponse
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'device_name' => 'required'
        ]);

        $user = User::create([
            'name' => request()->name,
            'email' => request()->email,
            'password' => Hash::make(request()->password),
        ]);

        return response()->json([
            'token' => $user->createToken(request()->device_name)->plainTextToken
        ]);
    }

    final public function logout(): JsonResponse
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out'
        ]);
    }
}
