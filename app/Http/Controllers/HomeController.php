<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $ids = auth()->user()->followings->pluck('id');
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(20);

        return view('home', 
        [
            'posts' => $posts
        ]);
    }   // Here End Function index
}   // Here End Class of HomeController
