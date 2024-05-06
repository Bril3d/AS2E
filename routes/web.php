<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageUploaderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/auth/{provider}/redirect', [SocialController::class, 'redirect'])->where('provider', 'google');

Route::get('/auth/{provider}/callback', [SocialController::class, 'callback'])->where('provider', 'google');

Route::get('/', HomeController::class);

Route::get('/project/{slug}', [ProjectController::class, "display"])->name('project.display');

Route::middleware(['auth', 'role:admin|moderator'])->group(function () {
    Route::resource('projects', ProjectController::class)->middleware(['auth']);
    Route::post('/projects', [ProjectController::class, 'store'])->name('project.store');
});


Route::post('/upload-image', ImageUploaderController::class)->name('upload-image');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'stats'])->middleware(['auth'])->name('dashboard.index');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::post('/user', [UserController::class, 'update'])->name('users.update');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::get('/files', [FileController::class, 'index'])->name('files.index');
    Route::post('/folder/{folder}', [FileController::class, 'folderCreate'])->name('files.folder');
    Route::resource('/settings', SettingController::class);
});


require __DIR__ . '/auth.php';
require __DIR__ . '/posts.php';
require __DIR__ . '/appointment.php';
require __DIR__ . '/files.php';
