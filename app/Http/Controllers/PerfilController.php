<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;


use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PerfilController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('perfil.index');
    }


    public function store(Request $request)
    {

        //capturar el request para modificarlo
        $request->request->add([
            'username', Str::slug($request->username)
        ]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:15', 'not_in:twitter,editar-perfil'],
            'email' => ['required', 'unique:users,email,' . auth()->user()->id, 'email', 'max:30'],
        ]);
        if ($request->imagen) {
            $imagenName = $this->saveImage($request);
        }
        //TODO: Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->email = $request->email;

        $usuario->imagen = $imagenName ?? auth()->user()->imagen ?? '';

        $usuario->save();
        return redirect()->route('post.index', $usuario->username);
    }

    private function saveImage($request)
    {
        //crear una instancia del manageer
        $manager = new ImageManager(new Driver());
        //imagen que viene del front
        $imagen = $request->file('imagen');
        //generamos un nombre de la imagen
        $nombreImagen =  Str::uuid() . "." . $imagen->extension();
        //le asignamos una ruta
        $imagenPath = public_path('profiles') . '/' . $nombreImagen;
        //Leemos la imagen
        $image = $manager->read($imagen);
        //Reedimencionamos la imagen
        $image->resize(1000, 1000);
        //Guardamos la imagen
        $image->save($imagenPath);
        return $nombreImagen;
    }
}
