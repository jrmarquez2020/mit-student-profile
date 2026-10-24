<?php

use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\TokenController;
use Illuminate\Support\Facades\Route;

Route::post('/tokens/create', [TokenController::class, 'create'])
    ->middleware('throttle:6,1');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/tokens/reports', [TokenController::class, 'createReportsToken']);
    Route::post('/logout', [TokenController::class, 'logout']);

    Route::middleware('abilities:students:read')->group(function () {
        Route::get('/students', [StudentController::class, 'index']);
        Route::get('/students/{student}', [StudentController::class, 'show']);
    });

    Route::middleware('abilities:students:write')->group(function () {
        Route::post('/students', [StudentController::class, 'store']);
        Route::put('/students/{student}', [StudentController::class, 'update']);
        Route::patch('/students/{student}', [StudentController::class, 'update']);
        Route::delete('/students/{student}', [StudentController::class, 'destroy']);
    });

    Route::get('/reports', [TokenController::class, 'reports']);
    Route::get('/user', fn () => request()->user());
});
