<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersManageController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideosManageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/videos', [VideoController::class,'index'])->name('videos');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('video.show');

Route::middleware(['auth', 'can:manage-videos'])->group(function () {
    Route::get('/video/create', [VideosManageController::class, 'create'])->name('video.create');
    Route::get('/video/manage', [VideosManageController::class, 'index'])->name('videos.manage');
    Route::post('videos/store', [VideosManageController::class,'store'])->name('video.store');
    Route::get('/videos/{video}/edit', [VideosManageController::class, 'edit'])->name('video.edit');
    Route::put('/videos/{video}', [VideosManageController::class, 'update'])->name('video.update');
    Route::get('/videos/{video}/delete', [VideosManageController::class, 'delete'])->name('video.delete');
    Route::delete('/videos/{video}/destroy', [VideosManageController::class, 'destroy'])->name('video.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('users');
    Route::get('/user/{user}', [UsersController::class, 'show'])->name('user.show');

});

Route::middleware(['auth', 'can:manage users'])->group(function () {
    Route::get('/users/manage', [UsersManageController::class, 'index'])->name('users.manage');
    Route::get('/users/create', [UsersManageController::class, 'create'])->name('user.create');
    Route::post('/users/store', [UsersManageController::class, 'store'])->name('user.store');
    Route::get('/users/{user}/edit', [UsersManageController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user}', [UsersManageController::class, 'update'])->name('user.update');
    Route::get('/users/{user}/delete', [UsersManageController::class, 'delete'])->name('user.delete');
    Route::delete('/users/{user}/destroy', [UsersManageController::class, 'destroy'])->name('user.destroy');
});



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

*/
