@extends('layouts.app')



@section('titulo')
{{$post->titulo}}
@endsection

@section('contenido')

<div class="container mx-auto md:flex">
    <div class="md:w-2/6">
        <img src="{{asset('uploads'. '/' . $post->imagen)}}" alt="Imagen del post {{$post->titulo}}">


        <div class="p-3 flex justify-between items-center">
            <div class="flex items-center gap-4">
                @auth

                <livewire:like-post :post="$post" />

                @endauth


            </div>

            @auth
            @if (auth()->user()->id === $post->user_id)
            <form action="{{route('posts.destroy', $post)}}" method="POST">
                @method('DELETE')
                @csrf
                <input type="submit" value='Eliminar publicación'
                    class="bg-red-500 rounded p-2 text-white font-bold mt-04 cursor-pointer" />
            </form>

            @endif
            @endauth
        </div>
        <div class="">
            <p class="font-bold">{{$post->user->username}}</p>
            <p class="text-sm text-gray-500">{{$post->created_at->diffForHumans()}}</p>
            <p class="mt-5">{{$post->descripcion}}</p>
        </div>


    </div>



    <div class="md:w-1/2 p-5">
        <div class="shadow bg-white p-5 mb-5">
            @auth
            <p class="text-xl font-bold text-center mb-4">Agrega un nuevo comentario</p>


            @if(session('mensaje'))
            <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                {{session('mensaje')}}</div>
            @endif

            <form action="{{route('comentario.store', ['post'=>$post, 'user'=>$user])}}" method="POST">
                @csrf
                <div class="mb-5">
                    <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                        Añade un Comentario
                    </label>
                    <textarea id="comentario" name="comentario" type="text" placeholder="Comentario de la publicación"
                        class="@error('comentario') border-red-500
                @enderror  border p-3 w-full rounded-lg"></textarea>
                    @error('comentario')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center ">{{$message}}</p>
                    @enderror
                </div>

                <input type="submit" value="Comentar"
                    class="bg-sky-600  hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full text-white p-3 rounded-lg">

            </form>
            @endauth

            <div class="bg-white shadow mb-5 max-h-96 overflow-y-auto mt-10">
                @if ($post->comentarios->count())
                @foreach ($post->comentarios as $comentario )
                <div class="p-5 border-gray-300 border-b">
                    <a href="{{route('post.index', $comentario->user)}}" class="font-bold mb-5 text-sm text-gray-500">
                        {{$comentario->user->username}}
                    </a>
                    <p>
                        {{$comentario->comentario}}
                    </p>
                    <div class="justify-between items-center">

                        <p class="text-sm text-gray-500">
                            {{$comentario->created_at->diffForHumans()}}
                        </p>
                    </div>
                </div>

                @endforeach
                @else
                <p class="p-10 text-center">No hay comentarios</p>
                @endif


            </div>
        </div>
    </div>
</div>

@endsection
