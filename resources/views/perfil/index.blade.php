@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 p-6 pb-10 bg-white shadow-2xl rounded-lg">
            @if (session('message'))
                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('message') }}</p>
            @endif
            <form action="{{ route('perfil.store') }}" enctype="multipart/form-data" method="POST" class="mt-10 md:mt-0">
                @csrf
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">Cambiar Username:</label>
                    <input type="text" id=username" name="username" placeholder="Cambia tu Nombre de Usuario" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror" value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="imagen class="mb-2 block uppercase text-gray-500 font-bold">Imagen Perfil:</label>
                    <input type="file" id=imagen" name="imagen" class="border p-3 w-full rounded-lg" accept=".jpg, .jpeg .png">
                </div>
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold"> Cambiar Correo Electronico:</label>
                    <input type="email" id=email" name="email" placeholder="Cambia tu Correo electronico" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{ auth()->user()->email }}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
                    @enderror
                </div>

                <p class="text-2xl font-bold uppercase text-gray-600 mx-auto my-10">Cambiar Contraseña</p>

                <div class="mb-5">
                    <label for="old_password" class="mb-2 block uppercase text-gray-500 font-bold">Cambiar Contraseña:</label>
                    <input type="password" id="old_password" name="old_password" placeholder="Coloca tu Contraseña Antigua" class="border p-3 w-full rounded-lg @error('old_password') border-red-500 @enderror">
                    @error('old_password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Nueva Contraseñá:</label>
                    <input type="password" id="password" name="password" placeholder="Coloca tu Nueva Cotraseñá" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-5">
                    <label for="password_confirmation" class="mb-2 block uppercase text-gray-500 font-bold">Confirmar Nueva Contraseña:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirma tu Nueva Contraseña" class="border p-3 w-full rounded-lg @error('password_confirmation') border-red-500 @enderror">
                    @error('password_confirmation')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
                    @enderror
                </div>
                <input type="submit" value="Crear Cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection