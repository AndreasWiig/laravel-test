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

// TODO: Move this to a new controller
Route::get('/version', function () {
    return response()->json(['version' => '0.0.1']);
});

// TODO: Make it possible to update a user with the PATCH HTTP method
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::get('/users', [UserController::class, 'get']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
