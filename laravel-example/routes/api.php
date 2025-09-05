<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;

Route::get('/user', fn()=>['ok' => true])->withoutMiddleware('auth:api');


route::prefix('post')->group(function(){
    Route::middleware(['throttle:api','auth:api','scopes:posts.read', 'role:viewer,editor,admin'])->group(function(){
        Route::get('/', [PostController::class, 'index']);
        Route::get('{posts}', [PostController::class, 'show']);
    });

    Route::middleware(['throttle:api','auth:api','scopes:posts.read', 'role:viewer,editor,admin'])->group(function(){
        Route::post('/', [PostController::class, 'store']);
        Route::put('{posts}', [PostController::class, 'update']);
        Route::delete('{posts}', [PostController::class, 'destroy']);
        Route::post('{posts}/restore', [PostController::class, 'restore'])
            ->middleware('scopes:posts.writer');
        
    });
});


Route::prefix('auth')->group(function(){
    Route::post('login', [AuthController::class, 'login']);
    Route::post('signup', [AuthController::class, 'signup']);
});

Route::middleware('auth:api')->group(function(){
    Route::get('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
});


Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('blog', BlogController::class);
Route::apiResource('posts', PostController::class)->middleware('throttle:api');
Route::post('posts/{id}/restore', [PostController::class, 'restore'])->middleware('throttle:api');
