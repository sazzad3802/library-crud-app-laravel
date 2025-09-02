<?php

use App\Http\Controllers\API\BookApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommonDataController;
use App\Http\Controllers\StandingDataController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {

    // Route::get('common-data/type/{type}', [CommonDataController::class, 'getCommonData']);
    Route::post('common-data', [CommonDataController::class, 'getCommonData']);
    Route::post('common-data/create', [CommonDataController::class, 'store']);

    Route::post('common-data/regions', [CommonDataController::class, 'getRegions']);

    Route::get('common-data/master', [CommonDataController::class, 'getMasterData']);

    Route::get('common-data/{id}', [CommonDataController::class, 'fetchById']);

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