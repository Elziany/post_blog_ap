<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});

Route::group(['prefix' => 'posts'] , function() {
    Route::get('/', [PostController::class, 'getPosts']);
    Route::get('/{id}', [PostController::class, 'getPost']);
    Route::post('/', [PostController::class, 'createPost'])->middleware('auth:sanctum');
    Route::put('/{id}', [PostController::class, 'updatePost'])->middleware('auth:sanctum');
    Route::delete('/{id}', [PostController::class, 'deletePost'])->middleware('auth:sanctum');
    Route::get('/user/{userId}', [PostController::class, 'getPostsByUser'])->middleware('auth:sanctum');
});
