@extends('layouts.app')


@section('titulo')
Editar perfil: {{auth()->user()->username}}
@endsection

@section('contenido')
<div class="md:flex md:justify-center">
    <div class="w-1/2 bg-white shadow p-6">
        <form action="{{route('perfil.store')}}" method="POST" enctype="multipart/form-data" class="mt-10 md:mt-0">
            @csrf
            <div class="mb-5">
                <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">
                    Usernmae
                </label>
                <input id="username" name="username" type="text" placeholder="Tu nombre de usuario" class="@error('username') border-red-500
                @enderror  border p-3 w-full rounded-lg" value={{auth()->user()->username}}>
                @error('username')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                    email
                </label>

                <input id="email" name="email" type="text" placeholder="Tu Email" class="@error('email') border-red-500
                @enderror  border p-3 w-full rounded-lg" value={{auth()->user()->email}}>
                @error('email')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="imagen" class="mb-2 block uppercase text-gray-500 font-bold">
                    Imagen perfil
                </label>
                <input id="imagen" name="imagen" type="file" accept=".jpg, .jpeg, .png, .gif"
                    class="border p-3 w-full rounded-lg" value="" />
            </div>
            <input type="submit" value="Guardar cambios"
                class="bg-sky-600  hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full text-white p-3 rounded-lg">
        </form>
    </div>
</div>
@endsection
