<?php

use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SubscriberController;
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
    Route::get('courses', [CourseController::class, 'index'])->name('index');
    Route::post('courses', [CourseController::class, 'store'])->name('store');
    Route::get('courses/{course}', [CourseController::class, 'show'])->name('show');
    Route::post('courses/{course}/files', [FileController::class, 'store'])->name('file.store');

    Route::get('courses/teacher_search', [SubscriberController::class, 'index'])->name('teachers.index');

    Route::get('search', [CourseController::class, 'search'])->name('search');
    Route::get('files/{file}', [FileController::class, 'show'])->name('files.show');
});

Route::middleware(['auth', 'verified'])->name('subscriptions.')->group(function() {
    Route::get('subscriptions', [SubscriptionController::class, 'index'])->name('index');
});

Route::middleware(['auth', 'verified'])->name('teachers.')->group(function() {
    Route::get('teachers', [SubscriberController::class, 'index'])->name('index');
    Route::post('teacher/{user}', [SubscriberController::class, 'store'])->name('store');
    Route::delete('teacher/{user}', [SubscriberController::class, 'destroy'])->name('destroy');
    Route::get('teachers/{course}', [SubscriberController::class, 'show'])->name('show');

    Route::get('profile/{user}', [SubscriberController::class, 'get_info'])->name('get_info');
});

require __DIR__.'/auth.php';
