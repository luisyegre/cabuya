<?php

namespace App\Http\Resources;

use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $this->loadCount(['reactions', 'comments']);
        $this->load([
            'user',
            'comments',
            'comments.user',
        ]);
        foreach ($this->comments as $comment) {
            $comment->loadCount('reactions');
        }

        return array_merge(
            parent::toArray($request),

        );
    }
}
