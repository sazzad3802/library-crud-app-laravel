<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/books', [BookController::class, 'index']);


Route::resource('books', BookController::class);
