<?php

use App\Http\Controllers\API\BookApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('books', BookApiController::class);
    
});