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
    public function all(Request $request)
    {
        $page = $request->has('page') ? $request->input('page') : 0;
        $limit = $request->has('limit') ? $request->input('limit') : 15;
        $posts = Post::orderBy('created_at', 'desc')
            ->limit($limit)
            ->offset($page)
            ->get()
            ->loadCount('reactions')
            ->load(['user'])
            ->toArray();

        return response(
            $posts
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
    public function like(Post $post)
    {
        $userId = auth()->user()->id;
        $reaction = $post->reactions()->where('user_id', $userId)->get();
        if (sizeof($reaction) == 0) {
            $post->reactions()->attach($userId);
            return response(['message' => 'like']);
        }
        $post->reactions()->detach($userId);
        return response(['message' => 'dis like']);

        // inertia('Posts/Index', ['message', 'like']);
    }
}
