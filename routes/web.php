<?php

use App\Http\Controllers\SeriesController;
use App\Http\Controllers\SeriesManageController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UsersManageController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideosManageController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/users', [UsersController::class, 'index'])->name('users');
Route::get('/user/{user}', [UsersController::class, 'show'])->name('user.show');




Route::get('/videos', [VideoController::class,'index'])->name('videos');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('video.show');

Route::get('/series', [SeriesController::class,'index'])->name('series');
Route::get('/serie/{serie}', [SeriesController::class, 'show'])->name('series.show');

    //Rutes per a gestionar videos amb permissos
Route::middleware(['auth', 'can:manage-videos'])->group(function () {
    Route::get('/video/manage', [VideosManageController::class, 'index'])->name('videos.manage');
    Route::get('/videos/{video}/edit', [VideosManageController::class, 'edit'])->name('video.edit');
    Route::get('/videos/{video}/delete', [VideosManageController::class, 'delete'])->name('video.delete');

    //Rutes per a gestionar notificacions
    Route::get('/notifications', function () {
        return view('notifications');
    })->name('notifications');
});
    //Rutes per a gestionar videos
Route::middleware(['auth'])->group(function () {
    Route::get('/video/create', [VideosManageController::class, 'create'])->name('video.create');
    Route::post('/videos/store', [VideosManageController::class,'store'])->name('video.store');
    Route::get('/videosUser/{video}/edit', [VideoController::class, 'edit'])->name('videoUser.edit');
    Route::put('/videos/{video}', [VideosManageController::class, 'update'])->name('video.update');
    Route::get('/videosUser/{video}/delete', [VideoController::class, 'delete'])->name('videoUser.delete');
    Route::delete('/videos/{video}/destroy', [VideosManageController::class, 'destroy'])->name('video.destroy');

    //Rutes per gestionar series
    Route::get('/series/create', [SeriesManageController::class, 'create'])->name('series.create');
    Route::post('/series/store', [SeriesManageController::class,'store'])->name('series.store');
    Route::get('/seriesUser/{serie}/edit', [SeriesController::class, 'edit'])->name('seriesUser.edit');
    Route::put('/series/{serie}', [SeriesManageController::class, 'update'])->name('series.update');
    Route::get('/seriesUser/{serie}/delete', [SeriesController::class, 'delete'])->name('seriesUser.delete');
    Route::delete('/series/{serie}/destroy', [SeriesManageController::class, 'destroy'])->name('series.destroy');
});

    //Rutes per gestionar series amb permissos
Route::middleware(['auth', 'can:manage-series'])->group(function () {
    Route::get('/series/manage', [SeriesManageController::class, 'index'])->name('series.manage');
    Route::get('/series/{serie}/edit', [SeriesManageController::class, 'edit'])->name('series.edit');
    Route::get('/series/{serie}/delete', [SeriesManageController::class, 'delete'])->name('series.delete');
});




    //Rutes per gestionar usuaris
Route::middleware(['auth', 'can:manage-users'])->group(function () {
    Route::get('/users/manage', [UsersManageController::class, 'index'])->name('users.manage');
    Route::get('/users/create', [UsersManageController::class, 'create'])->name('user.create');
    Route::post('/users/store', [UsersManageController::class, 'store'])->name('user.store');
    Route::get('/users/{user}/edit', [UsersManageController::class, 'edit'])->name('user.edit');
    Route::put('/users/{user}', [UsersManageController::class, 'update'])->name('user.update');
    Route::get('/users/{user}/delete', [UsersManageController::class, 'delete'])->name('user.delete');
    Route::delete('/users/{user}/destroy', [UsersManageController::class, 'destroy'])->name('user.destroy');
});



Route::get('/test-mail', function () {
    Mail::raw('Test email content', function($message) {
        $message->to('superadmin@videosapp.com')
            ->subject('Test Email from Laravel');
    });

    return 'Test email sent. Check your Mailtrap inbox.';
});

Route::get('/check-admins', function() {
    $admins = \App\Models\User::where('super_admin', true)->get();
    return $admins->pluck('email');
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
