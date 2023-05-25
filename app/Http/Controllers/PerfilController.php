<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Middleware;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:edirar-perfil'],
            'email' => ['required', 'email', 'unique:users,email,' . auth()->user()->id, 'max:30'],
        ]);

        if($request->imagen) {
            $img = $request->file('imagen');
            $nameImg = Str::uuid() . "." . $img->extension();
    
            $imgServer = Image::make($img);
            $imgServer->fit(1000, 1000);
    
            $imgPath = public_path('perfiles') . '/' . $nameImg;
            $imgServer->save($imgPath);
        }

        if ($request->filled('password')) {
            if(!Hash::check($request->old_password, auth()->user()->password)) {
                return back()->with('message', 'El Password Antiguo no es Válido');
            }
    
            $this->validate($request, [
                'password' => ['confirmed', 'min:6']
            ]);
        }

        // Guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $nameImg ?? auth()->user()->imagen ?? null;
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->password) ?? auth()->user()->password;
        $usuario->save();

        // Redireccionar al usuario
        return redirect()->route('posts.index', $usuario->username);
    }
}
