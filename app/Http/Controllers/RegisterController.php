<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index() 
    {
        return view('auth/register');
    }   // Here End Function Index

    public function store(Request $request)
    {
        // dd($request);

        // Modify Request
        $request->request->add(['username' => Str::slug( $request->username ) ]);

        // Validation
    $request->validate
        (
        [
            'name' =>'required',
            'username' =>'required|unique:users|min:3|max:30',
            'email' =>'required|unique:users|email|max:60',
            'password' => 'required|min:6|confirmed'
        ]);

        // Store Data To Database
        User::create
        ([
            'name' => $request->name,
            'username'=> $request->username,
            'email'=> $request->email,
            'password' => Hash::make( $request->password ),
            'password_confirmation' => $request->password_confirmation,
        ]);

        //  Authenticate the User
        // auth()->attempt
        // ([
        //     'email'=> $request->email,
        //     'password' => $request->password
        // ]);

        // Other Form of Authentication
        auth()->attempt( $request->only('email', 'password') );

        // Redirect
        return redirect()->route('posts.index');
    }   // Here End Function Store
}
