@extends('layouts.app')

@section('titulo')
Crear nueva publicación
@endsection

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush

@section('contenido')
<div class="md:flex md:items-center">
    <div class="md:w-1/2 px-10">
        <form action="{{route('imagenes.store')}}" method="POST" id="dropzone" enctype="multipart/form-data"
            class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center">
            @csrf
        </form>
    </div>
    <div class="md:w-1/2  bg-white p-10 rounded-lg shadow-xl mt-10 md:mt-0">
        <form action="{{route('posts.store')}}" method="POST">
            @csrf
            <div class="mb-5">
                <label for="titulo" class="mb-2 block uppercase text-gray-500 font-bold">
                    Titulo
                </label>
                <input id="titulo" name="titulo" type="text" placeholder="Titulo de la publicación" class="@error('titulo') border-red-500
            @enderror  border p-3 w-full rounded-lg" value={{old("titulo")}}>
                @error('titulo')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{$message}}</p>
                @enderror
            </div>
            <div class="mb-5">
                <label for="descripcion" class="mb-2 block uppercase text-gray-500 font-bold">
                    Descripción
                </label>
                <textarea id="descripcion" name="descripcion" type="text" placeholder="Descripción de la publicación"
                    class="@error('descripcion') border-red-500
                @enderror  border p-3 w-full rounded-lg">{{old("descripcion")}}</textarea>
                @error('descripcion')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{$message}}</p>
                @enderror
            </div>

            <div class="mb-5">
                <input type="hidden" name="imagen" id="" value="{{old('imagen')}}">
                @error('imagen')
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{$message}}</p>
                @enderror
            </div>


            <input type="submit" value="Publicar"
            class="bg-sky-600  hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full text-white p-3 rounded-lg">



        </form>
    </div>
</div>

</div>
@endsection
