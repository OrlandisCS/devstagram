<div>
    @if($posts->count())
    <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($posts as $post)
        <div class="">
            <a href="{{route('post.show',['post'=>$post, 'user'=> $post->user ])}}">
                <img src="{{asset('uploads') . '/' . $post->imagen}}" alt="Imagen del post {{$post->titulo}}">
            </a>
        </div>
        @endforeach
    </div>

    <div class="my-10">

        {{$posts->links('pagination::tailwind')}}
    </div>

    @else
    <p class="font-bold text-lg text-gray-500 text-center">No hay posts, sigue a alguien ver sus pots</p>
    @endif
</div>
