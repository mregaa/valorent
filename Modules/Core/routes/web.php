<?php

use Illuminate\Support\Facades\Route;
use Modules\Core\Http\Controllers\CoreController;
use Modules\Core\Http\Controllers\CategoryController;
use Modules\Core\Http\Controllers\ProfileController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('cores', CoreController::class)->names('core');
    
    // Category Management Routes
    Route::prefix('admin/categories')->name('admin.categories.')->middleware('can:manage-categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}', [CategoryController::class, 'show'])->name('show');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
    });
    
    // Profile Management Routes
    Route::prefix('profiles')->name('profiles.')->group(function () {
        Route::get('/me', [ProfileController::class, 'show'])->name('show');
        Route::get('/me/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/me', [ProfileController::class, 'update'])->name('update');
    });
});
