<?php

use App\Http\Controllers\Menus\MenuController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('menu')->name('menu.')->controller(MenuController::class)->group(function () {
        Route::get('', "index")->name('index');
        Route::get('/create', "create")->name('create');
        Route::post('', "store")->name('store');
        Route::get('/{menu}', "show")->name('show');
        Route::get('/{menu}/edit', "edit")->name('edit');
        Route::put('/{menu}', "update")->name('update');
        Route::delete('/{menu}', "destroy")->name('destroy');
    });
});
