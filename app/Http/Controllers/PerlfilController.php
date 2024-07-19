<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;

class PerlfilController extends Controller
{
    public function index()
    {
        return view('perfil.index');
    }   // Here End Function Index

    public function store( Request $request )
    {        
        $request->request->add(['username' => Str::slug($request->username)]);

        $request->validate
        ([
            'username' => 'required|unique:users|min:3|max:20',
        ]);

        if( $request->imagen)
        {
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . '.' . $imagen->extension();
    
            $imagenServidor = ImageManager::imagick()->read( $imagen );
            $imagenServidor->resize(1000, 1000);
    
            $imagenPath = public_path('uploads') . '/' . $nombreImagen;
            $imagenServidor->save( $imagenPath );
        }   // Here End If

        // Save Data
        $usuario = User::find( auth()->user()->id  );

        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? '';

        $usuario->save();

        return redirect()->route('posts.index', $usuario->username);
    }   // Here End Function Store
}   // Here End Class PerlfilController
