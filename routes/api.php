<?php

use App\Http\Controllers\API\BookApiController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::apiResource('books', BookApiController::class)->names([
        'index' => 'api.books.index',
        'store' => 'api.books.store',
        'show' => 'api.books.show',
        'update' => 'api.books.update',
        'destroy' => 'api.books.destroy',
    ]);
});