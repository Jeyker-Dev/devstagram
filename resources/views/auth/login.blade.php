@extends('layout.app')

@section('titulo')
    Inicia Sesion En Devstagram
@endsection

@section('contenido')

    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen Crear Cuenta">
        </div>

        <div class="md:w-6/12 bg-white p-6 rounded-lg shadow-xl">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if( session('mensaje') )
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center 
                uppercase"> {{ session('mensaje') }}</p>
                @endif
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" id="email" name="email" placeholder="Tu Email" class="border p-3 w-full rounded-lg
                    @error('email') border-red-500 @enderror" value="{{ old('name') }}" />
                    @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center 
                    uppercase"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input type="password" id="password" name="password" placeholder="Tu Password" class="border p-3 w-full rounded-lg
                    @error('password') border-red-500 @enderror" />
                    @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center 
                    uppercase"> {{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <input type="checkbox" name="remember"> <label class="text-gray-500 font-bold text-sm" for="">Mantener Mi Sesion Abierta</label>
                </div>

                <input type="submit" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                uppercase font-bold w-full p-3 text-white rounded-lg" value="Iniciar Sesion "> 
            </form>
        </div>
    </div>
@endsection