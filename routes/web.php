<?php declare(strict_types=1);

use App\Http\Controllers\SDLTController;

// SDLT calculation
Route::get('/', [SDLTController::class, 'form'])->name('sdlt');
Route::post('/calculate', [SDLTController::class, 'calculate'])->name('sdlt.calculate');
