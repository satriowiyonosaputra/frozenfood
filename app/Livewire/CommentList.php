<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;

class CommentList extends Component
{
    public function render()
    {
        return view('livewire.comment-list', [
            'comments' => Comment::latest()->get(),
        ]);
    }
}
