<?php

use App\Http\Controllers\API\BookApiController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {


    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);

        Route::middleware('auth:api')->group(function () {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('user', [AuthController::class, 'me']);
            Route::post('refresh', [AuthController::class, 'refresh']);
        });
    });

    Route::middleware('auth:api')->group(function () {
        Route::apiResource('books', BookApiController::class)->names([
            'index' => 'api.books.index',
            'store' => 'api.books.store',
            'show' => 'api.books.show',
            'update' => 'api.books.update',
            'destroy' => 'api.books.destroy',
        ]);
    });

});