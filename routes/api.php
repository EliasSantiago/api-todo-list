<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ListController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/register','register')->name('register');
        Route::post('/login', 'login')->name('login');
    });

    Route::middleware(['auth:api'])->group(function () {
        Route::controller(ListController::class)->group(function () {
            Route::get('/lists', 'index');
            Route::get('/lists/{id}', 'show');
            Route::post('/lists', 'store');
            Route::put('/lists', 'update');
            Route::delete('/lists', 'delete');
        });
    });
});
