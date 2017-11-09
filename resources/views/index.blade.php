@extends('layouts.pagina_inicial')

@section('titulo_principal', config('app.name'))

@section('links')
    <a href="{{ url('/aplicativo') }}">Aplicativos</a>
    <a href="{{ url('/') }}">Documentação</a>
    <a href="https://github.com/hercolysm/Updater" target="_blank">GitHub</a>
    <a href="{{ url('/sobre') }}">Sobre</a>
@endsection
