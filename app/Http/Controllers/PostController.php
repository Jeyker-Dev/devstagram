<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index( User $user )
    {
        return view('dashboard', 
        [
            'user' => $user
        ]);
    }   // Here End Function Index

    public function create()
    {
        return view('posts.create');
    }   // Here End Function Create

    public function store( Request $request )
    {
        $request->validate
        ([
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);

        // Post::create
        // ([
        //     'titulo' => $request->titulo,
        //     'descripcion' => $request->descripcion,
        //     'imagen' => $request->imagen,
        //     'user_id' => auth()->user()->id
        // ]);

        $request->user()->posts()->create
        ([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id
        ]);

        return redirect()->route('posts.index', auth()->user()->username );
    }   // Here End Function Store

}   // Here End Class PostController
