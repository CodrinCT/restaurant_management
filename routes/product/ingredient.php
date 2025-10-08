<?php

use App\Http\Controllers\IngredientController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('ingredient')->name('ingredient.')->controller(IngredientController::class)->group(function () {
        Route::get('', "index")->name('index');
        Route::get('/create', "create")->name('create');
        Route::post('', "store")->name('store');
        Route::get('/{ingredient}', "show")->name('show');
        Route::get('/{ingredient}/edit', "edit")->name('edit');
        Route::put('/{ingredient}', "update")->name('update');
        Route::delete('/{ingredient}', "destroy")->name('destroy');
    });
});
