<?php

use App\Http\Controllers\VideoController;
use App\Http\Controllers\VideosManageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/videos', [VideoController::class,'index'])->name('videos');
Route::get('/videos/manage', [VideosManageController::class, 'index'])->name('videos.manage');
Route::get('/videos/create', [VideosManageController::class, 'create'])->name('video.create');
Route::post('videos/store', [VideosManageController::class,'store'])->name('video.store');
Route::get('/videos/{video}', [VideoController::class, 'show'])->name('video.show');
Route::get('/videos/{video}/edit', [VideosManageController::class, 'edit'])->name('video.edit');
Route::put('/videos/{video}', [VideosManageController::class, 'update'])->name('video.update');
Route::get('/videos/{video}/delete', [VideosManageController::class, 'delete'])->name('video.delete');
Route::delete('/videos/{video}/destroy', [VideosManageController::class, 'destroy'])->name('video.destroy');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


