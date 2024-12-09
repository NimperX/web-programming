<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function() {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('signup', [AuthController::class, 'signup'])->name('signup');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::get('me', [AuthController::class, 'me'])->name('current_user');
});

Route::prefix('v1')->group(function() {    
    Route::prefix('posts')->name('posts.')->group(function() {
        Route::get('/', [PostController::class, 'index'])->name('index');
        
        Route::middleware('auth:api')->group(function() {
            Route::post('/', [PostController::class, 'store'])->name('store');
        });
    });

    Route::get('/health', function() {
        return response([
            'msg' => 'API application is up and running'
        ]);
    })->name('health');
});