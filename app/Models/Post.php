<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'likes',
        'dislikes',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reactions(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "posts_users_reaction");
    }
}
