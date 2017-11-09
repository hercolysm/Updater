@extends('layouts.lista')

@section('title', ' - Aplicativos')

@section('titulo_principal', 'Aplicativos')

@section('content')
    <a href="{{ url('/') }}" class="pull-left">Voltar</a>
    <a href="{{ url('/aplicativo/create') }}" class="pull-right">Novo Aplicativo</a>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th colspan="3">Nome</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lista as $aplicativo)
                <tr>
                    <td>{{ $aplicativo->nome }}</td>
                    <td class="col-xs-2">
                        Versão Atual: {{ $VersaoModel::getVersaoAtual($aplicativo->id_aplicativo) }}
                    </td>
                    <td class="col-xs-2">
                        <a href="{{ url('/aplicativo/'.$aplicativo->id_aplicativo) }}">Detalhes</a>
                        <a href="{{ url('/aplicativo/edit/'.$aplicativo->id_aplicativo) }}">Editar</a>
                        <a href="{{ url('/aplicativo/destroy/'.$aplicativo->id_aplicativo) }}">Excluir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">Nenhum aplicativo encontrado</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
