<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\FileController;
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

    Route::get('files/{file:id}', [FileController::class, 'show'])->name('file.show');
});

require __DIR__.'/auth.php';
