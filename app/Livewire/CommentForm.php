<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;

class CommentForm extends Component
{
    public $name;
    public $message;

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:100',
            'message' => 'required|string|max:1000',
        ]);

        Comment::create([
            'name' => $this->name,
            'message' => $this->message,
        ]);

        $this->reset(['name', 'message']);

        session()->flash('success', 'Komentar berhasil dikirim!');
    }

    public function render()
    {
        return view('livewire.comment-form');
    }
}

