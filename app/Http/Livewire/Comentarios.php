<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Comentario;

class Comentarios extends Component
{
    public $user;
    public $post;
    public $comentario;
    
    public function mount($post, $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    public function comentar()
    {
        $this->validate([
            'comentario' => 'required|max:255'
        ]);

        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_id' => $this->post->id,
            'comentario' => $this->comentario
        ]);

        $this->post->load('comentarios');
        $this->comentario = '';
    }

    public function render()
    {
        return view('livewire.comentarios', [
            'post' => $this->post,
            'user' => $this->user,
        ]);
    }
    
}
