<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        $img = $request->file('file');
        $nameImg = Str::uuid() . "." . $img->extension();

        $imgServer = Image::make($img);
        $imgServer->fit(1000, 1000);

        $imgPath = public_path('uploads') . '/' . $nameImg;
        $imgServer->save($imgPath);

        return response()->json(['img' => $nameImg]);
    }
}
