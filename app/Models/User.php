<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function postsReacted()
    {
        return $this->belongsToMany(Post::class, "posts_users_reaction");
    }
    public function likePost(Post $post)
    {
        try {
            DB::beginTransaction();
            $userId = $this->id;
            $userAlreadyLike = $post->reactions()->find($userId);

            if ($userAlreadyLike) {
                $post->reactions()->detach($userId);
            } else {
                $post->reactions()->attach($userId);
            }
            $post->save();
            DB::commit();
            return $post;
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
