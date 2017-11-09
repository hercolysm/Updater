@extends('layouts.lista')

@section('title', ' - Cadastro')

@section('titulo_principal', 'Cadastrar Aplicativo')

@section('content')
    <form method="POST" action="{{ url('/aplicativo/store') }}" class="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <input type="hidden" name="id_aplicativo" value="{{ $aplicativo->id_aplicativo ?? '' }}">
        <div class="form-group col-md-12">
            <label for="nome">Nome</label>
            <br>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $aplicativo->nome ?? '' }}" required="required">
        </div>
         <div class="form-group col-md-12">
            <label for="descricao">Descrição</label>
            <br>
            <input type="text"  class="form-control" id="descricao" name="descricao" value="{{ $aplicativo->descricao ?? '' }}" required="required">
        </div>
        <div class="form-group col-md-6">
            <label for="github">GitHub</label>
            <br>
            <input type="text" class="form-control" id="github" name="github" value="{{ $aplicativo->github ?? '' }}">
        </div>
        <div class="form-group col-md-6">
            <label for="gitlab">GitLab</label>
            <br>
            <input type="text" class="form-control" id="gitlab" name="gitlab" value="{{ $aplicativo->gitlab ?? '' }}">
        </div>
        <div class="form-group col-md-4">
            <label for="desenvolvimento">Desenvolvimento</label>
            <br>
            <input type="text" class="form-control" id="desenvolvimento" name="desenvolvimento" value="{{ $aplicativo->desenvolvimento ?? '' }}" required="required">
        </div>
        <div class="form-group col-md-4">
            <label for="producao">Produção</label>
            <br>
            <input type="text" class="form-control" id="producao" name="producao" value="{{ $aplicativo->producao ?? '' }}" required="required">
        </div>
        <div class="form-group col-md-4">
            <label for="backup">Backup</label>
            <br>
            <input type="text" class="form-control" id="backup" name="backup" value="{{ $aplicativo->backup ?? '' }}" required="required">
        </div>
        <div class="col-md-12">
            <a href="{{ url('/aplicativo') }}">Voltar</a>
            <button type="submit" class="btn btn-default pull-right">Salvar</button>
        </div>
    </form>
@endsection
