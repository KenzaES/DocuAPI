<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware('throttle:10,1');

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/products', [ProductController::class, 'addProduct']);
    Route::put('/products/{id}', [ProductController::class, 'editProduct']);
    Route::patch('/products/{id}', [ProductController::class, 'editProduct']);
    Route::get('/products/{id}', [ProductController::class, 'getProduct']);
    Route::get('/products', [ProductController::class, 'showProducts']);
    Route::delete('/products/{id}', [ProductController::class, 'deleteProduct']);
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
});
