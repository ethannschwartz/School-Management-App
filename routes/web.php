<?php

use Illuminate\Foundation\Application;
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

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', 'verified'])->name('courses.')->group(function() {
    Route::get('/courses', [\App\Http\Controllers\CourseController::class, 'index'])->name('index');
    Route::post('/courses', [\App\Http\Controllers\CourseController::class, 'store'])->name('store');
    Route::get('/courses/{course}', [\App\Http\Controllers\CourseController::class, 'show'])->name('show');

    Route::post('/courses/{course}/announcements', [\App\Http\Controllers\AnnouncementController::class, 'store'])->name('announcements.store');
    Route::delete('/announcements/{announcement}', [\App\Http\Controllers\AnnouncementController::class, 'destroy'])->name('announcements.delete');

    Route::post('/courses/{course}/assignments', [\App\Http\Controllers\AssignmentController::class, 'store'])->name('assignments.store');

    Route::post('/courses/{keycode}', [\App\Http\Controllers\FollowController::class, 'store_course_follow'])->name('course_follower.store');
});

Route::middleware(['auth', 'verified'])->name('groups.')->group(function() {
    Route::get('/groups', [\App\Http\Controllers\GroupController::class, 'index'])->name('index');
    Route::post('/groups', [\App\Http\Controllers\GroupController::class, 'store'])->name('store');
    Route::get('/groups/{group}', [\App\Http\Controllers\GroupController::class, 'show'])->name('show');

    Route::post('/groups/{keycode}', [\App\Http\Controllers\FollowController::class, 'store_group_follow'])->name('group_follower.store');
});

Route::middleware(['auth', 'verified'])->name('schedule.')->group(function() {
    Route::get('/schedule', function (){
        return Inertia::render('Schedule');
    })->name('index');
});

Route::middleware(['auth', 'verified'])->name('profile.')->group(function() {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('index');
    Route::get('/profile', [\App\Http\Controllers\FileController::class, 'index'])->name('index');
    Route::post('/profile', [\App\Http\Controllers\FileController::class, 'store'])->name('store');
});


require __DIR__.'/auth.php';
