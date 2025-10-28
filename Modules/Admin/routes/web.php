<?php

use Illuminate\Support\Facades\Route;
use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\UnitController;
use Modules\Admin\Http\Controllers\UserController;
use Modules\Admin\Http\Controllers\DashboardController;
use Modules\Admin\Http\Controllers\ReportController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('admins', AdminController::class)->names('admin');
    
    // Unit Management Routes
    Route::prefix('admin/units')->name('admin.units.')->group(function () {
        Route::get('/', [UnitController::class, 'index'])->name('index');
        Route::get('/create', [UnitController::class, 'create'])->name('create');
        Route::post('/', [UnitController::class, 'store'])->name('store');
        Route::get('/{unit}', [UnitController::class, 'show'])->name('show');
        Route::get('/{unit}/edit', [UnitController::class, 'edit'])->name('edit');
        Route::put('/{unit}', [UnitController::class, 'update'])->name('update');
        Route::delete('/{unit}', [UnitController::class, 'destroy'])->name('destroy');
    });
    
    // User Management Routes
    Route::prefix('admin/users')->name('admin.users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}', [UserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });
    
    // Report Routes
    Route::prefix('admin/reports')->name('admin.reports.')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/rental-history', [ReportController::class, 'rentalHistory'])->name('rental-history');
        Route::get('/unit-status', [ReportController::class, 'unitStatusReport'])->name('unit-status');
        Route::get('/user-activity', [ReportController::class, 'userActivityReport'])->name('user-activity');
        Route::get('/revenue', [ReportController::class, 'revenueReport'])->name('revenue');
        Route::get('/rental-history/export', [ReportController::class, 'exportRentalHistory'])->name('rental-history.export');
    });
});
