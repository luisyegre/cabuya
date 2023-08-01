<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index()
    {
        return inertia('Posts/Index', [
            'user' => auth()->user(),
            // 'posts' => Post::all()
        ]);
    }
    public function all()
    {
        return response(
            Post::all()->load(['user'])->loadCount('reactions')
        );
    }
    public function isThereNewPost(Request $request)
    {
        //otra solucion mas practica 
        //es guardar en cache en el backend
        //y incrementar la cantidad de nuevos posts 
        //cada vez que se agrega uno.
        $lastCout = $request->input('lastCout');
        $count = Post::all()->count();
        if ($count <= $lastCout) {
            return response(['message' => 'no hay nuevos posts']);
        }
        return response(['message' => 'hay nuevos posts', 'amount' => $count - $lastCout]);
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $post = Post::create([
            'body' => $request->input('body'),
            'user_id' => $user->id
        ]);
        return response([
            'message' => ['content' => 'Post creado', 'type' => 'success']
        ]);
    }
    public function show(Post $post)
    {
        $post->load('user');
        $post->loadCount('reactions');
        return response($post);
    }
    public function like(int $post_id)
    {
        // auth()->user()->likePost($post_id);
        return response(['message' => 'like']);
        // inertia('Posts/Index', ['message', 'like']);
    }
}
