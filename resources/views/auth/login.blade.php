@extends('layouts.app')


@section('titulo')
Inicia Sesión en DevStagram
@endsection


@section('contenido')
<div class="md:flex md:justify-center md:gap-6  md:items-center">
    <div class="md:w-6/12 p-5">
        <img src="{{asset('img/login.jpg')}}" alt="imagen de login de usuarios">
    </div>
    <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
        <form action="{{route('login')}}" method="POST">
            @csrf

            @if (session('mensaje'))
            <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{session('mensaje')}}</p>

            @endif
            <div class="mb-5">
                <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">
                    email
                </label>
                <input id="email" name="email" type="text" placeholder="Tu Email" class="@error('email') border-red-500
                @enderror  border p-3 w-full rounded-lg" value={{old("email")}}>
                @error('email')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">
                    Password
                </label>

                <input id="password" name="password" type="password" placeholder="Tu password" class="@error('password') border-red-500
                @enderror  border p-3 w-full rounded-lg" />
                @error('password')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{$message}}</p>
                @enderror
            </div>
<div class="mb-5">
    <input type="checkbox" name="remember" id="remember">
    <label class="text-sm text-gray-500 " for="remember">
        Recuerdame
        </label>
</div>
            <input type="submit" value="Iniciar Sesión"
                class="bg-sky-600  hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full text-white p-3 rounded-lg">
        </form>
    </div>

</div>

@endsection()
