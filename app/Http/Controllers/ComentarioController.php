<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //
    public function store( Request $request, User $user, Post $post )
    {
        // Validate
        $request->validate
        ([
            'comentario' => 'required|max:255'
        ]);

        // Store the Data
        Comentario::create
        ([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'comentario' => $request->comentario,
        ]);

        // Show Message
        return back()->with('mensaje', 'Comentario Agregado');

    }   // Here End Function Store
}   // Here End Class ComentarioController
