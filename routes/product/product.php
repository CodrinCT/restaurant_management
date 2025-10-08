<?php

use App\Http\Controllers\Products\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function () {
        Route::get('', "index")->name('index');
        Route::get('/create', "create")->name('create');
        Route::post('', "store")->name('store');
        Route::get('/{product}', "show")->name('show');
        Route::get('/{product}/edit', "edit")->name('edit');
        Route::put('/{product}', "update")->name('update');
        Route::delete('/{product}', "destroy")->name('destroy');
    });
});
