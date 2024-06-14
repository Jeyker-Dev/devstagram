<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index( User $user )
    {
        dd( $user );
        return view('dashboard');
    }   // Here End Function Index

}   // Here End Class PostController
