<?php

use Illuminate\Support\Facades\Route;
use Modules\Rental\App\Http\Controllers\RentalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->prefix('rental')->name('rental.')->group(function () {
    // Create rental
    Route::get('/create/{unitId}', [RentalController::class, 'create'])->name('create');
    Route::post('/store/{unitId}', [RentalController::class, 'store'])->name('store');
    
    // My rentals
    Route::get('/my-rentals', [RentalController::class, 'myRentals'])->name('my-rentals');
    
    // Show rental detail
    Route::get('/{id}', [RentalController::class, 'show'])->name('show');
});
