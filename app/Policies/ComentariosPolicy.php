<?php

namespace App\Policies;

use App\Models\Comentario;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ComentariosPolicy
{
    public function deleteComentario(User $user, Comentario $comentario): bool
    {
        return auth()->user()->id === $comentario->user_id;
    }
}
