<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;

class ImagenController extends Controller
{
    public function store( Request $request )
    {
        $imagen = $request->file('file');

        $nombreImagen = Str::uuid() . '.' . $imagen->extension();

        $imagenServidor = ImageManager::imagick()->read( $imagen );
        $imagenServidor->resize(1000, 1000);

        $imagenPath = public_path('uploads') . '/' . $nombreImagen;
        $imagenServidor->save( $imagenPath );

        return response()->json( ['imagen' => $nombreImagen ] );
    }   // Here End Function Store
}   // Here End Class ImagenController
