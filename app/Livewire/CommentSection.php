<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Comment;

class CommentSection extends Component
{
    public $name;
    public $message;

    protected $rules = [
        'name' => 'required|string|max:100',
        'message' => 'required|string|max:1000',
    ];

    public function submit()
    {
        $this->validate();

        Comment::create([
            'name' => $this->name,
            'message' => $this->message,
        ]);

        $this->reset('name', 'message');

        session()->flash('success', 'Komentar berhasil dikirim.');
    }

    public function delete($id)
    {
        Comment::findOrFail($id)->delete();
    }

    public function render()
    {
        return view('livewire.comment-section', [
            'comments' => Comment::latest()->get(),
        ]);
    }
}


