@extends('layouts.lista')


@section('title', ' - Usuários')

@section('titulo_principal', 'Usuários')

@section('content')
	<a href="{{ url('/') }}" class="pull-left">Voltar</a>
    <a href="{{ url('/usuario/create') }}" class="pull-right">Novo Usuário</a>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th colspan="2">Usuários</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lista as $usuario)
                <tr>
                    <td>{{ $usuario->name }}</td>
                    <td class="col-xs-2">
                        <a href="{{ url('/usuario/edit/'.$usuario->id) }}">Editar</a>
                        <a href="{{ url('/usuario/destroy/'.$usuario->id) }}">Excluir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">Nenhum usuário encontrado</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
