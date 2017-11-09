@extends('layouts.pagina_inicial')

@section('title', ' - ' . $aplicativo->nome)

@section('top_right')
    <a href="{{ url('/aplicativo') }}">Aplicativos</a>
@endsection

@section('titulo_principal', $aplicativo->nome)

@section('links')
    <a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/instalacao') }}">Instalação</a>
    <a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/versao') }}">Versões</a>
    <a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/documentacao') }}">Documentação</a>
    @if ($aplicativo->github)
        <a href="{{ $aplicativo->github }}" target="_blank">GitHub</a>
    @endif
    @if ($aplicativo->gitlab)
        <a href="{{ $aplicativo->gitlab }}" target="_blank">GitLab</a>
    @endif
    <a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/sobre') }}">Sobre</a>
@endsection
