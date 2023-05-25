@extends('layouts.app')

@section('titulo')
    Principal
@endsection

@section('contenido')
    <x-listar-post :posts="$posts" />
@endsection