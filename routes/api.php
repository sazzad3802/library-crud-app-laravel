<?php

use App\Http\Controllers\API\BookApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CommonDataController;
use App\Http\Controllers\StandingDataController;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function () {

    // Public routes
    Route::prefix('auth')->group(function () {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']); 
    });

    // Protected routes
    Route::middleware('auth:api')->group(function () {
        
        Route::post('auth/logout', [AuthController::class, 'logout']);
        Route::get('auth/user', [AuthController::class, 'me']);
        Route::post('auth/refresh', [AuthController::class, 'refresh']);

        Route::post('common-data', [CommonDataController::class, 'getCommonData']);
        Route::post('common-data/create', [CommonDataController::class, 'store']);
        Route::post('common-data/regions', [CommonDataController::class, 'getRegions']);
        Route::get('common-data/master', [CommonDataController::class, 'getMasterData']);
        Route::get('common-data/{id}', [CommonDataController::class, 'fetchById']);

    });
});
