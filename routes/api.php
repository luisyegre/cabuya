<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::controller(PostController::class)->group(function () {
    Route::get('/posts', 'index');
    Route::middleware('auth:sanctum')->get('/posts/{post}', 'show');
    Route::middleware('auth:sanctum')->post('/posts/{post}/like', 'like');
    Route::middleware('auth:sanctum')->post('/posts', 'store');
});
Route::controller(UserController::class)->group(function () {
    Route::middleware('auth:sanctum')->post('/users/profile', 'profile');
});
Route::controller(AuthController::class)->group(function () {
    Route::post('/auth/login', 'login');
    Route::post('/auth/register', 'register');
    Route::middleware('auth:sanctum')->post('/auth/logout', 'logout');
});
