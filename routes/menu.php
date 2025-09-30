<?php

use App\Http\Controllers\Menus\MenuController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('menu', [MenuController::class, "index"])->name('menu.index');
});
