<?php

use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpertiseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageUploaderController;
use App\Http\Controllers\NotificationsClearController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeSettingController;
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

Route::get('/chatbot', [ChatbotController::class, 'index'])->name('chatbot.index');
Route::post('/chatbot', [ChatbotController::class, 'AiResponse'])->name('chatbot.response');

Route::get('/project/{slug}', [ProjectController::class, "display"])->name('project.display');
Route::get('/expertise/{slug}', [ExpertiseController::class, "display"])->name('expertise.display');

Route::middleware(['auth', 'permission:Projects CRUD'])->group(function () {
    Route::resource('projects', ProjectController::class);
    Route::post('/projects', [ProjectController::class, 'store'])->name('project.store');
});
Route::middleware(['auth', 'permission:Expertises CRUD'])->group(function () {
    Route::resource('/expertises', ExpertiseController::class);
    Route::post('/expertises', [ExpertiseController::class, 'store'])->name('expertise.store');
});

Route::post('/upload-image', ImageUploaderController::class)->name('upload-image');

Route::middleware('auth')->group(function () {
    Route::post('/notifications', NotificationsClearController::class)->name('notifications.clear');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', [DashboardController::class, 'stats'])->middleware(['auth', 'permission:Dashboard View'])->name('dashboard.index');

Route::resource('roles', RoleController::class)->middleware(['auth', 'permission:Roles CRUD']);
Route::resource('permissions', PermissionController::class)->middleware(['auth', 'permission:Permissions CRUD']);
Route::resource('/settings', SettingController::class)->middleware(['auth', 'permission:Settings CRUD']);

Route::middleware(['auth', 'permission:Settings CRUD'])->prefix('admin/home')->group(function () {
    Route::get('settings', [HomeSettingController::class, 'index'])->name('admin.home.settings');
    Route::post('hero', [HomeSettingController::class, 'updateHero'])->name('admin.home.hero');
    Route::post('hero/image', [HomeSettingController::class, 'uploadHeroImage'])->name('admin.home.hero.image');
    Route::delete('hero/image/{index}', [HomeSettingController::class, 'deleteHeroImage'])->name('admin.home.hero.image.delete');
    Route::post('features', [HomeSettingController::class, 'updateFeatures'])->name('admin.home.features');
    Route::post('services', [HomeSettingController::class, 'updateServices'])->name('admin.home.services');
    Route::post('stats', [HomeSettingController::class, 'updateStats'])->name('admin.home.stats');
    Route::post('faq', [HomeSettingController::class, 'updateFaq'])->name('admin.home.faq');
    Route::post('chatbot', [HomeSettingController::class, 'updateChatbot'])->name('admin.home.chatbot');
    Route::post('general', [HomeSettingController::class, 'updateGeneral'])->name('admin.home.general');
});


Route::middleware(['auth', 'permission:Users CRUD'])->group(function () {
    Route::resource('users', UserController::class);
    Route::post('/user', [UserController::class, 'update'])->name('users.update');
});

Route::middleware(['auth', 'permission:File Explorer CRUD'])->group(function () {
    Route::get('/files', [FileController::class, 'index'])->name('files.index');
    Route::post('/folder/{folder}', [FileController::class, 'folderCreate'])->name('files.folder');
});


require __DIR__ . '/auth.php';
require __DIR__ . '/posts.php';
require __DIR__ . '/appointment.php';
require __DIR__ . '/files.php';
