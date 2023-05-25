@extends('layouts.app')

@section('titulo')
    Inicia Sesión en Postedia.com
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-8/12 p-5">
            <img src="{{ asset('img/login.jpg') }}" alt="Imagen Login" class="rounded-lg">
        </div>
        <div class="md:w-8/12 bg-white p-6 rounded-lg shadow-2xl">
            <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf
                @if (session('message'))
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ session('message') }}</p>
                @endif
                <div class="mb-4">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">Email:</label>
                    <input type="email" id="email" name="email" placeholder="Tu Correo Electronico" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="mb-2 block uppercase text-gray-500 font-bold">Contraseña:</label>
                    <input type="password" id="password" name="password" placeholder="Tu Contraseña" class="border p-3 w-full rounded-lg @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember" class="text-gray-500 text-sm">Matener mi Sesión Abierta</label>
                </div>
                <input type="submit" value="Iniciar Sesión" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg">
            </form>
        </div>
    </div>
@endsection