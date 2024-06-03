@extends('layout.app')

@section('titulo')
    Registrate En Devstagram
@endsection

@section('contenido')

    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Imagen Crear Cuenta">
        </div>

        <div class="md:w-6/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="">
                <div class="mb-5">
                    <label for="name" class="mb-2 block uppercase text-gray-500 font-bold">Nombre</label>
                    <input type="text" id="name" name="name" placeholder="Tu Nombre" class="border p-3 w-full rounded-lg" />
                </div>

                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">UserName</label>
                    <input type="text" id="username" name="username" placeholder="Tu Nombre de Usuario" class="border p-3 w-full rounded-lg" />
                </div>

                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email</label>
                    <input type="email" id="email" name="email" placeholder="Tu Email" class="border p-3 w-full rounded-lg" />
                </div>

                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Password</label>
                    <input type="password" id="password" name="password" placeholder="Tu Password" class="border p-3 w-full rounded-lg" />
                </div>

                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Repetir Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Repite Tu Password" class="border p-3 w-full rounded-lg" />
                </div>

                <input type="submit" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer 
                uppercase font-bold w-full p-3 text-white rounded-lg" value="Crear Cuenta"> 
            </form>
        </div>
    </div>
@endsection