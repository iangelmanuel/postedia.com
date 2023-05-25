<div>
    <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
        @if ($post->comentarios->count())
            @foreach ($post->comentarios as $comentario)
                <div class="flex-col p-5 border-gray-300 border-b relative">
                    @if(auth()->user()->id === $comentario->user_id)
                        <form action="{{ route('comentarios.destroy', $comentario->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="absolute right-2 top-0 mt-2 bg-red-500 text-white p-1 rounded-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </form>
                    @endif
                    <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">{{ $comentario->user->username }}</a>
                    <p>{{ $comentario->comentario }}</p>
                    <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                </div>
            @endforeach
        @else
            <p class="p-10 text-center">No Hay Comentarios Aún</p>
        @endif
    </div>
    @auth
        <form wire:submit.prevent="comentar">
            @csrf
            <div class="mb-5">
                <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">Añade un Comentario</label>
                <textarea id="comentario" name="comentario" placeholder="Descripción de la Publicación" class="border p-3 w-full rounded-lg @error('comentario') border-red-500 @enderror" wire:model="comentario"></textarea>
                @error('comentario')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
                @enderror
            </div>
            <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
        </form>
    @endauth
</div>
