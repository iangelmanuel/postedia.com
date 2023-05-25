<div>
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
            @foreach ($posts as $post)
                <div class="bg-white p-3 pb-5 shadow-2xl rounded-lg hover:transition-all hover:translate-y-1.5">
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del Post {{ $post->titulo }}">
                    </a>
                    <div class="flex mt-4 ml-2 gap-4">
                        <img src="{{ $post->user->imagen ? asset('perfiles') . '/' .  $post->user->imagen : asset('img/usuario.svg') }}" alt="Imagen User" class="rounded-lg w-10">
                        <div class="flex-col">
                            <p class="font-bold">{{ $post->user->username }}</p>
                            <p class="text-gray-600">{{ $post->descripcion }}</p>
                            <p class="text-sm text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="my-10 ">{{ $posts->links('pagination::simple-tailwind') }}</div>

    @else
        <p class="text-center">No Hay Posts, Sigue a Alguien para Poder Mostrar sus Posts</p>
    @endif
</div>