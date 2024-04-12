<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/', function () {
    return Inertia::render('Home', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register')
    ]);
});



Route::middleware('auth')->group(function () {
    Route::get('/profile/{id?}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('/dashboard', [DashboardController::class, 'stats'])->name('dashboard.index');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/files', [FileController::class, 'index'])->name('files.index');
    Route::delete('/files', [FileController::class, 'destroy'])->name('files.destroy');
    Route::delete('/files/revert/{file}', [FileController::class, 'revert'])->name('files.revert');
    Route::post('/files', [FileController::class, 'upload'])->name('files.upload');
    Route::post('/files/process', [FileController::class, 'process'])->name('files.process');
    Route::post('/files/{folder}', [FileController::class, 'folderCreate'])->name('files.folder');
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('/settings', SettingController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/new', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    require __DIR__ . '/appointment.php';
});
