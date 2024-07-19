@extends ('layout.app')

@section('titulo')

    Perfil: {{ $user->username }}
@endsection


@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="w-8/12 lg:w-6/12 px-5">
                <img src="{{ $user->imagen ? asset('perfiles') . '/' . $user->imagen : asset('img/usuario.svg') }}" alt="Imagen Usuario">
            </div>

            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start md:justify-center py-10">
                
                <div class="flex items-center gap-2">
                    <p class="text-gray-700 text-xl">{{ $user->username }}</p>

                    @auth
                        @if( $user->id === auth()->user()->id )
                            <a href="{{ route('perfil.index', $user)}}" class="text-gray-500 hover:text-gray-600 cursor-pointer">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                            </a>
                        @endif
                    @endauth
                </div>

                <p class="text-gray-800 text-sm my-3 font-bold">
                    {{ $user->followers->count() }}
                    <span class="font-normal"> @choice('seguidor|seguidores', $user->followers->count() ) </span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Siguiendo</span>
                </p>

                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->posts->count() }}
                    <span class="font-normal">Posts</span>
                </p>

                @auth
                    @if( $user->id != auth()->user()->id )
                        @if( !$user->siguiendo( auth()->user() ) )
                    <form method="POST" action="{{ route('users.follow', $user->username ) }}">
                        @csrf
                        
                        <input type="submit" class="bg-blue-600 hover:bg-blue-700 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer" value="Seguir"/>
                    </form>
                        @else

                    <form action="{{route('users.unfollow', $user->username)}}">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="bg-red-600 hover:bg-red-700 text-white uppercase rounded-lg px-3 py-1 text-xs font-bold cursor-pointer mt-2" value="Dejar de Seguir"/>
                    </form>
                        @endif
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>


        <x-listar-post :posts="$posts" />
    </section>
@endsection