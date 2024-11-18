<?php

use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
    
    Route::prefix('posts')->name('posts.')->group(function() {
        Route::get('/', [PostController::class, 'index'])->name('index');
        Route::post('/', [PostController::class, 'store'])->name('store');
    });

    Route::get('/health', function() {
        return response([
            'msg' => 'API application is up and running'
        ]);
    });
});