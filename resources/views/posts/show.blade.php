@extends('layout.app')

@section('titulo')

    Post: {{ $post->titulo }}
@endsection

@section('contenido')
    <div class="container mx-auto flex items-center">

        <div class="md:w-1/2">
            <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del Post {{$post->titulo}}">
            @auth
            <div class="p-3  flex items-center gap-4">
                <livewire:like-post :post="$post" />
            @endauth
            </div>

            <p class="font-bold">{{ $post->user->username}}</p>
            <p class="text-gray-500"> {{ $post->created_at->diffForHumans() }} </p>
            <p class="text-justify mt-2 "> {{ $post->descripcion }} </p>

            @auth
                @if (auth()->user()->id == $post->user_id)
                    <div class="flex gap-2 mt-5">
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar" class="bg-red-500 hover:bg-red-700 transition-colors p-3 text-white rounded-lg">
                        </form>
                    </div>
                    
                @endif
            @endauth
        </div>
        <div class="md:w-1/2 p-5">
            @auth

            <div class="shadow bg-white p-5 mb-5">
                <p class="text-xl font-bold text-center mb-4">Agrega un Nuevo Comentario</p>

                @if(session('mensaje'))
                    <div class="bg-green-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                        {{ session('mensaje')}}
                    </div>
                @endif

                <form action="{{ route('comentarios.store', ['post' => $post, 'user' => $user ]) }}" method="POST">
                    @csrf
                    <div class="mb-5">
                        <label for="comentario" class="mb-2 block uppercase text-gray-500 font-bold">
                            Comentario
                        </label>
                        <textarea id="comentario" name="comentario" placeholder="Agrega un Comentario" class="border p-3 w-full 
                        rounded-lg @error('comentario') border-red-500 @enderror" /></textarea>
                        @error('comentario')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center 
                        uppercase"> {{ $message }}</p>
                        @enderror
                    </div>

                    <input type="submit" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                    uppercase font-bold w-full p-3 text-white rounded-lg" value="Comentar"> 
                </form>
            </div>
            @endauth

            <div class="bg-white shadow mb-5 max-h-96 overflow-y-scroll mt-10">
                @if( $post->comentarios->count())
                    @foreach ($post->comentarios as $comentario)
                        <div class="p-5 border-gray-300 border-b ">
                            <a href="{{ route('posts.index', $comentario->user) }}">
                                {{$comentario->user->username}}
                            </a>
                            <p> {{ $comentario->comentario }} </p>
                            <p class="text-sm text-gray-500"> {{ $comentario->created_at->diffForHumans() }} </p>
                        </div>
                    @endforeach
                @else
                    <p class="text-center p-10">No hay comentarios</p>
                @endif
            </div>
        </div>

    </div>
@endsection