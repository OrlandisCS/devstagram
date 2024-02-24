<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function index()
    {
        return view('/auth.register');
    }

    public function store(Request $request)
    {
        //capturar el request para modificarlo
        $request->request->add(['username',Str::slug($request->username)]);


        //laravel validaciones
        $this->validate($request, [
            'name' => ['required', 'min:3', 'max:15'],
            'username' => ['required', 'unique:users', 'min:3', 'max:15'],
            'email' => ['required', 'unique:users', 'email', 'max:30'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        User::create([
            'name' =>  $request->name,
            'username' =>$request->username,
            'email' => $request->email,
            'password' => $request->password
        ]);

        //TODO: Autenticar usuario
        auth()->attempt([
            'email'=>$request->email,
            'password'=>$request->password,
        ]);

        //Otra forma de autenticar el usuario
        auth()->attempt($request->only('email', 'password'));

        //TODO: redireccionar el usuario si todo esta bien

        return redirect()->route('post.index', auth()->user()->username);
    }
}
