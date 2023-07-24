<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('auth')->group(function(){
	Route::get('/', [PostController::class, 'index']);
	Route::get('/home', [PostController::class, 'index'])->name('home');
	Route::get('/posts/{post}', [PostController::class, 'show']);
	Route::post('/posts/{post}/like', [PostController::class, 'like']);
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/login', [AuthController::class, 'loginView'])->name('login-view');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/register', [AuthController::class, 'registerView'])->name('register-view');
