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
    Route::post('/courses/{course}/assignments', [\App\Http\Controllers\AssignmentController::class, 'store'])->name('assignments.store');
});

Route::middleware(['auth', 'verified'])->name('profile.')->group(function() {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'index'])->name('index');

    Route::post('/profile', );
});

Route::middleware(['auth', 'verified'])->name('groups.')->group(function() {
    Route::get('/groups', [\App\Http\Controllers\GroupController::class, 'index'])->name('index');
    Route::post('/groups', [\App\Http\Controllers\GroupController::class, 'store'])->name('store');
    Route::get('/groups/{group}', [\App\Http\Controllers\GroupController::class, 'show'])->name('show');
});


require __DIR__.'/auth.php';
