<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function store( Request $request, User $user )
    {
        $user->followers()->attach( auth()->user()->id ) ;

        return back();
    }   // Here End Function store

    public function destroy( Request $request, User $user )
    {
        $user->followers()->detach( auth()->user()->id );

        return back();
    }   // Here End Function destroy
}   // Here End Class FollowerController
