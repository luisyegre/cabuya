<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'user_id',
        'post_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reactions(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "posts_users_reaction");
    }
    public function isCommentary(): bool
    {
        return $this->post_id != null;
    }
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
    public function comments(): HasMany
    {

        return $this->hasMany(Post::class);
    }
}
