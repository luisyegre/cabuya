<?php

namespace App\Http\Livewire;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Posts extends Component
{
    public Post $post;
    public ?User $user;
    public int $likes = 0;
    public $isLogged = false;
    // private  $userLogged;
    public function mount()
    {
        $this->user = Auth::user();
        $this->isLogged = $this->user != null;
    }
    public function like()
    {
        var_dump(auth()->user());
        if ($this->isLogged)
            $this->post = $this->user->likePost($this->post);
    }

    public function render()
    {
        return view('livewire.posts');
    }
}
