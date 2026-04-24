<?php declare(strict_types=1);

use App\Http\Controllers\SDLTController;

//   http://127.0.0.1:8000 todo: remove

// SDLT calculation
Route::get('/', [SDLTController::class, 'form'])->name('sdlt.form');
Route::post('/calculate', [SDLTController::class, 'calculate'])->name('sdlt.calculate');
