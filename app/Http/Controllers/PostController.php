<?php

namespace App\Http\Controllers;

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

}   // Here End Class PostController
