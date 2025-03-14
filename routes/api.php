<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrickheadzController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\DashboardController;

Route::get('/', [BrickheadzController::class, 'index']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/brickheadz', [BrickheadzController::class, 'index']);
Route::get('/brickheadz/{id}', [BrickheadzController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user/collection', [CollectionController::class, 'index']);
    Route::post('/user/collection', [CollectionController::class, 'store']);
    Route::put('/user/collection/{collection}', [CollectionController::class, 'update']);
    Route::get('/user/{user}/dashboard/stats', [DashboardController::class, 'getStats']);
});
