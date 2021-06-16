<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/version', [\App\Http\Controllers\VersionController::class, 'index']);

Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::patch('/users/{user}', [UserController::class, 'update']);
Route::get('/users', [UserController::class, 'get']);

// Public routes
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);

// Protected Routes
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
