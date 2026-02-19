<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::post('/posts', [PostController::class,'create']);
// Route::get('/posts', [PostController::class,'index']);
// Route::put('/posts/{id}', [PostController::class, 'update']);
// Route::delete('/posts/{id}', [PostController::class, 'destroy']);
// Route::get('/posts/{id}', [PostController::class, 'show']);
Route::resource('/posts', PostController::class);
