@extends('layouts.lista')

@section('title', ' - ' . $aplicativo->nome .' - Versão')

@section('titulo_principal', $aplicativo->nome)

@section('content')
    <form method="POST" action="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/versao/store') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <input type="hidden" name="id_versao" value="{{ $versao->id_versao ?? '' }}">
        <div class="form-group col-md-6">
            <label for="arquivo">Arquivos</label>
            <br>
            <textarea name="arquivo" id="arquivo" class="form-control" cols="50" rows="5">{{ $versao->arquivo ?? '' }}</textarea>
        </div>
        <div class="form-group col-md-6">
            <label for="script">Scripts</label>
            <br>
            <textarea name="script" id="script" class="form-control" cols="50" rows="5">{{ $versao->script ?? '' }}</textarea>
        </div>
        <div class="form-group col-md-12">
            <label for="sql">SQL</label>
            <br>
            <textarea name="sql" id="sql" class="form-control" cols="50" rows="5">{{ $versao->sql ?? '' }}</textarea>
        </div>
        <div class="form-group col-md-2">
            <label for="implementacao">Implementação</label>
            <br>
            <select name="implementacao" id="implementacao" class="form-control">
                <option value="0">Não</option>
                <option value="1" {{ isset($versao->implementacao) && $versao->implementacao == 1 ? 'selected' : '' }}>Sim</option>
            </select>
        </div>
        <div class="form-group col-md-10">
            <label for="descricao_implementacao">Descrição da Implementação</label>
            <br>
            <textarea name="descricao_implementacao" id="descricao_implementacao" class="form-control" cols="50" rows="5">{{ $versao->descricao_implementacao ?? '' }}</textarea>
        </div>
        <div class="form-group col-md-2">
            <label for="correcao">Correção</label>
            <br>
            <select name="correcao" id="correcao" class="form-control">
                <option value="0">Não</option>
                <option value="1" {{ isset($versao->correcao) && $versao->correcao == 1 ? 'selected' : '' }}>Sim</option>
            </select>
        </div>
        <div class="form-group col-md-10">
            <label for="descricao_correcao">Descrição da Correção</label>
            <br>
            <textarea name="descricao_correcao" id="descricao_correcao" class="form-control" cols="50" rows="5">{{ $versao->descricao_correcao ?? '' }}</textarea>
        </div>
        <div class="form-group col-md-2">
            <label for="pre_lancamento">Pré-Lancamento</label>
            <br>
            <select name="pre_lancamento" id="pre_lancamento" class="form-control">
                <option value="0">Não</option>
                <option value="1" {{ isset($versao->pre_lancamento) && $versao->pre_lancamento == 1 ? 'selected' : '' }}>Sim</option>
            </select>
        </div>
        <div class="form-group col-md-8">
            <label for="identificador">Identificador</label>
            <br>
            <input type="text" name="identificador" id="identificador" class="form-control" value="{{ $versao->identificador ?? '' }}">
        </div>
        <div class="form-group col-md-2">
            <label for="incompativel">Incompatível com a anterior</label>
            <br>
            <select name="incompativel" id="incompativel" class="form-control">
                <option value="0">Não</option>
                <option value="1" {{ isset($versao->incompativel) && $versao->incompativel == 1 ? 'selected' : '' }}>Sim</option>
            </select>
        </div>
        <div class="checkbox pull-right">
            <label for="gerar_arquivo">
                <input type="checkbox" name="gerar_arquivo" id="gerar_arquivo" value="1"> Gerar Arquivo
            </label>
            <label for="enviar_arquivo">
                <input type="checkbox" name="enviar_arquivo" id="enviar_arquivo" value="1"> Enviar Arquivo
            </label>
        </div>
        <div class="col-md-12">
            <ul class="list-inline pull-right">
                <li><a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/versao') }}" class="btn btn-default">Voltar</a></li>
                <li><button type="submit" class="btn btn-default">Salvar</button></li>
            </ul>            
        </div>
    </form>
@endsection
