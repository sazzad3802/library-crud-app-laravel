<?php

use App\Http\Controllers\API\BookApiController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    Route::apiResource('projects', ProjectController::class)->names([
        'index' => 'api.projects.index',
        'store' => 'api.projects.store',
        'show' => 'api.projects.show',
        'update' => 'api.projects.update',
        'destroy' => 'api.projects.destroy',
    ]);
    Route::post('projects/bulk', [ProjectController::class, 'bulkStore']);
});

