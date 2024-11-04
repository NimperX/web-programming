<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutesController;
use App\Http\Controllers\TagController;

Route::get('/', [RoutesController::class, 'redirectToWelcome']);
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome-route');


Route::get('/products', [ProductController::class, 'list']);

Route::get('/tags', [TagController::class, 'list']);

// GET - Reading Data from Server But not mutating
// POST - Submit data and mutate server
// PUT - Submit data and mutate server (edit) - Full submission
// PATCH - Submit data and mutate server (partial edit) - Partial submission
// DELETE -  Delete resources from the server
// OPTIONS - Route related to CORS (Cross Origin Resource Sharing)