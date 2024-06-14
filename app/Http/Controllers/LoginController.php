<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }   // Here End Function Index

    public function store( Request $request)
    {
        dd( $request->remember );

        $request->validate
        ([
            'email' =>'required|email',
            'password' => 'required|min:6'
        ]);

        if( !auth()->attempt( $request->only('email','password'), $request->remember ) )
        {
            return back()->with('mensaje','Credenciales Incorrectas');
        }   // Here End If

        return redirect()->route('posts.index');
    }   // Here End Funciton Store
}   // Here End Class LoginController
