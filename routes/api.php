<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/register','register');
        Route::post('/login', 'login');
    });

    Route::middleware(['auth:api'])->group(function () {
        Route::controller(AuthController::class)->group(function () {
            Route::get('/me', 'me');
        });

        Route::controller(TaskController::class)->group(function () {
            Route::post('/tasks', 'store');
            Route::get('/tasks', 'index');
            Route::get('/tasks/{id}', 'show');
            Route::put('/tasks/{task}', 'update')->middleware('can:update,task');
            Route::delete('/tasks/{task}', 'destroy')->middleware('can:delete,task');
        });
    });
});
