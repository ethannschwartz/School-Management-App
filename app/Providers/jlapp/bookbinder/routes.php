<?php namespace Jlapp\Bookbinder;

use EpubController;
use Illuminate\Routing\Route;
use MobiController;
use PdfController;

Route::get('publish/epub', [EpubController::class, 'create'])->name('create');
Route::get('publish/mobi', [MobiController::class, 'create'])->name('create');
Route::get('publish/epub', [PdfController::class, 'create'])->name('create');

