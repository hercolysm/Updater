@extends('layouts.lista')

@section('title', ' - ' . $aplicativo->nome . ' - Versões')

@section('titulo_principal')
    <a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo) }}">{{ $aplicativo->nome }}</a>
@endsection

@section('content')
    <a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/versao/create') }}" class="pull-right">Nova Versão</a>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th colspan="4">Versão</th>
            </tr>
        </thead>
        <tbody>
            @forelse($versoes as $versao)
                <tr>
                    <td>{{ $VersaoModel::getVersao($aplicativo->id_aplicativo, $versao->id_versao) }}</td>
                    <td>
                        <ul class="list-inline pull-right">
                            @if(!$versao->arquivo_enviado)
                                <li><a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/versao/edit/'. $versao->id_versao) }}">Editar</a></li>
                                <li><a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/versao/destroy/'. $versao->id_versao) }}">Excluir</a></li>
                            @endif
                        </ul>
                    </td>
                    <td class="text-center col-xs-1">
                        @if($versao->arquivo_gerado)
                            <p class="text-success">Gerado</p>
                        @else
                            <a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/versao/gerar/'. $versao->id_versao) }}" class="text-warning">Gerar</a>
                        @endif
                    </td>
                    <td class="text-center col-xs-1">
                        @if($versao->arquivo_enviado)
                            <p class="text-success" title="{{ 'Enviado ' . date('d/m/Y H:i:s', strtotime($versao->data_envio)) }}">Enviado</p>
                        @else
                            <a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/versao/enviar/'. $versao->id_versao) }}" class="text-warning">Enviar</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Nenhuma versão encontrada</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
