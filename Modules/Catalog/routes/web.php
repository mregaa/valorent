<?php

use Illuminate\Support\Facades\Route;
use Modules\Catalog\App\Http\Controllers\CatalogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::prefix('catalog')->name('catalog.')->group(function () {
    Route::get('/', [CatalogController::class, 'index'])->name('index');
    Route::get('/{id}', [CatalogController::class, 'show'])->name('show');
});
