<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'body' => 'required|string'
        ]);
        if ($validation->fails())
            return response()->json($validation->errors());

        $user = $request->user();
        $post = $user
            ->posts()
            ->create(['body' => $request->body]);

        return $post;
    }
    public function index(Request $request)
    {
        $posts = Post::all();
        return Inertia::render('Posts/Index', ['posts' => $posts]);
    }
    public function show(Post $post)
    {
        $post->load('user');
        $post->loadCount('reactions');
        return Inertia::render('Posts/Show', ['post' => $post]);
    }
    public function like(int $post_id)
    {
        try {
            // auth()->user()->likePost($post_id);
            return Inertia::render('Posts/Index', ['message', 'like']);
        } catch (\Exception $e) {
            return Inertia::render('Posts/Index', ['message' => $e->getMessage()]);
        }
    }
}
