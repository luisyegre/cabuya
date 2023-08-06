<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;
use App\Jobs\Notification;
use App\Models\Post;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return inertia('Posts/Index', [
            'user' => auth()->user(),
            // 'posts' => Post::all()
        ]);
    }
    public function all(Request $request)
    {

        $posts = Post::query()->where('post_id', '=', null);
        $q = $request->input('q');
        $search = $request->has('search') ? $request->input('search') : 'post';
        $page = $request->has('page') ? $request->input('page') : 0;
        $limit = $request->has('limit') ? $request->input('limit') : 15;
        if ($q != '' && $search === 'user') {
            $users = User::where('name', 'LIKE', '%' . $q . '%')->get();
            $posts = $posts->WhereBelongsTo($users);
        }
        if ($q != '' && $search === 'post') {
            $posts->where('body', 'LIKE', '%' . $q . '%');
        }
        $posts = $posts
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->offset($page)
            ->get()
            ->loadCount(['reactions', 'comments'])
            ->load(['user']);

        return response(new PostCollection($posts));
    }
    public function myPosts(Request $request)
    {

        $posts = Post::query()->where('post_id', '=', null)->where('user_id', auth()->user()->id);
        $q = $request->input('q');
        $search = $request->has('search') ? $request->input('search') : 'post';
        $page = $request->has('page') ? $request->input('page') : 0;
        $limit = $request->has('limit') ? $request->input('limit') : 15;
        if ($q != '' && $search === 'user') {
        }
        if ($q != '' && $search === 'post') {
            $posts->where('body', 'LIKE', '%' . $q . '%');
        }
        $posts = $posts
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->offset($page)
            ->get()
            ->loadCount(['reactions', 'comments'])
            ->load(['user']);

        return response(new PostCollection($posts));
    }
    public function countPosts(Request $request)
    {
        //otra solucion mas practica 
        //es guardar en cache en el backend
        //y incrementar la cantidad de nuevos posts 
        //cada vez que se agrega uno.
        $count = Post::all()->count();
        return response([
            'count' => $count,
            'message' => 'posts',
        ]);
    }
    public function store(Request $request)
    {
        $user = Auth::user();
        $post = Post::create([
            'body' => $request->input('body'),
            'user_id' => $user->id,
            'post_id' => null
        ]);
        return response([
            'message' => ['content' => 'Post creado', 'type' => 'success']
        ]);
    }
    public function show(Post $post)
    {
        return response(new PostResource($post));
    }
    public function comment(Request $request, int $postId)
    {
        $user = auth()->user();
        $comment = Post::create([
            'user_id' => $user->id,
            'post_id' => $postId,
            'body' => $request->input('body')
        ]);
        return response([
            'message' => 'comment send',
            'comment' => new PostResource($comment)
        ], Response::HTTP_CREATED);
    }
    public function like(Post $post)
    {
        $userId = auth()->user()->id;
        $reponseBody = ['message' => 'like'];
        $reaction = $post
            ->reactions()
            ->where('user_id', $userId)
            ->get();

        if (sizeof($reaction) > 0) {
            $reponseBody['message'] = 'dis like';
            $post->reactions()->detach($userId);
        } else {
            $reponseBody['message'] = 'like';
            $post->reactions()->attach($userId);
        }
        $user = $post->user;
        //notify the owner of post
        // Notification::dispatch($user, $reponseBody['message'])->onQueue('notifications');
        return response($reponseBody);


        // inertia('Posts/Index', ['message', 'like']);
    }
}
