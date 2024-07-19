<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function index( User $user )
    {
        $posts = Post::where('user_id', $user->id)->latest()->paginate(5);
        return view('dashboard', 
        [
            'user' => $user,
            'posts' => $posts
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

    public function show(User $user, Post $post)
    {
        return view('posts.show',
        [
            'post' => $post,
            'user' => $user
        ]);
    }   // Here End Function Show

    public function destroy( Post $post)
    {
        if( $post->user_id === auth()->user()->id )
        {
            Gate::authorize('delete', $post);
            $post->delete();

            // Delete Image
            $imagen_path = public_path('uploads/' . $post->imagen);

            if( File::exists($imagen_path ) )
            {
                unlink( $imagen_path );
            }   // Here End If

            return redirect()->route('posts.index', auth()->user()->username );
        }   // Here End If
        else
        {
            dd('Its Not the Same Person');
        }   // Here End Else
    }   // Here End Function Destroy

}   // Here End Class PostController
