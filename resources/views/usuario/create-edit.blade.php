@extends('layouts.lista')

@section('title', ' - Usuários')

@section('titulo_principal', 'Usuários')

@section('content')
    <form method="POST" action="{{ url('/usuario/store') }}" class="form">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
        <input type="hidden" name="id" value="{{ $usuario->id ?? '' }}">
        <div class="form-group col-md-6">
            <label for="name">Nome</label>
            <br>
            <input type="text" class="form-control" id="name" name="name" value="{{ $usuario->name ?? '' }}" required="required">
        </div>
        <div class="form-group col-md-6">
            <label for="email">E-mail (login)</label>
            <br>
            <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email ?? '' }}" required="required">
        </div>
        <div class="form-group col-md-6">
            <label for="password">Senha</label>
            <br>
            <input type="password"  class="form-control" id="password" name="password" value="" {{ isset($usuario->id) ? '' : 'required=/"required/"' }}>
        </div>
        <div class="form-group col-md-6">
            <label for="password_confirm">Confirmar Senha</label>
            <br>
            <input type="password"  class="form-control" id="password_confirm" name="password_confirm" value="" {{ isset($usuario->id) ? '' : 'required=/"required/"' }}>
        </div>
        <div class="col-md-12">
            <a href="{{ url('/usuario') }}">Voltar</a>
            <button type="submit" class="btn btn-default pull-right">Salvar</button>
        </div>
        <div class="col-md-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                @foreach($tabs as $tab => $tab_text)
                    <li role="presentation" class="{{ ($tab == 'aplicativos') ? 'active' : '' }}""><a href="#{{ $tab }}" aria-controls="{{ $tab }}" role="tab" data-toggle="tab">{{ $tab_text }}</a></li>
                @endforeach
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                @foreach($tabs as $tab => $tab_text)
                     <div role="tabpanel" class="tab-pane {{ ($tab == 'aplicativos') ? 'active' : '' }}" id="{{ $tab }}">
                        <p><strong>ACL {{ $tab_text }}</strong></p>
                        @foreach($Acl::getGrupo($tab) as $grupo)
                            <input type="checkbox" name="acl_acao[]" value="{{ $grupo->id_acl_acao }}" {{ $Acl::verifyPermission($usuario->id, $grupo->id_acl_acao) ? 'checked=\"checked\"' : '' }}> {{ $grupo->descricao }}
                            <br>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </form>
@endsection
