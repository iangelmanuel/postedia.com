<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // dd($request); -> Accede a la informacion que envian
        // dd($request->get('name')) -> Accede a cada una de los parametros

        // Validar Formulario por atributos name
        $this->validate($request, [
            'name' => ['required', 'min:4', 'max:10'],
            'username' => ['required', 'unique:users', 'min:4', 'max:30'],
            'email' => ['required', 'unique:users', 'email', 'max:30'],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Implementar los parametros a la base de datos con configuraciones
        User::create([
            'name' => $request->name,
            'username' => Str::slug($request->username), // Impide los espacios y las tildes de las letras
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        // Autenticar al usuario que se registro
        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ]);

        auth()->attempt($request->only('email', 'password'));

        // Redireccionarlo a su muro
        return redirect()->route('posts.index', auth()->user()->username);

    }
}
