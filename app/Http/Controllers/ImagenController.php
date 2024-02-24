<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;


use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImagenController extends Controller
{

    public function store(Request $request)
    {

        //crear una instancia del manageer
        $manager = new ImageManager(new Driver());
        //imagen que viene del front
        $imagen = $request->file('file');
        //generamos un nombre de la imagen
        $nombreImagen =  Str::uuid() . "." . $imagen->extension();
        //le asignamos una ruta
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;

        //Leemos la imagen
        $image = $manager->read($imagen);


        //Reedimencionamos la imagen
        $image->resize(1000, 1000);


        //Guardamos la imagen
        $image->save($imagenPath);


        return response()->json(['imagen' =>   $nombreImagen]);
    }
}
