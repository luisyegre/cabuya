<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
	Route::get(
		'/',
		[PostController::class,  'index']
	)->name('home-view');
	Route::get(
		'/posts',
		[PostController::class,  'all']
	);
	Route::post(
		'/posts',
		[PostController::class, 'store']
	)->name('create-post');
	Route::get(
		'/post-count',
		[PostController::class, 'countPosts']
	);
	Route::post(
		'/posts/{post}/like',
		[PostController::class, 'like']
	);
	Route::post(
		'/posts/{post_id}/comment',
		[PostController::class, 'comment']
	);
	Route::get(
		'/posts/{post_id}/show',
		fn (int $postId) => inertia('Posts/Show', ['postId' => $postId])
	)->name('post-show-view');

	Route::get(
		'/posts/{post}',
		[PostController::class, 'show']
	);
	Route::post(
		'/logout',
		[AuthController::class, 'logout']
	)->name('logout');

	Route::get(
		'/register',
		fn () => inertia('Auth/Register')
	)->name('register-view');
});

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', fn () => inertia('Auth/Login'))->name('login-view');
Route::get('/register', fn () => inertia('Auth/Register'))->name('register-view');
