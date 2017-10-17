<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Updater - {{ $aplicativo->nome }} - {{ $versao->id_versao ?? 'Nova Versão' }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 42px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{ $aplicativo->nome }} -> {{ $versao->id_versao ?? 'Nova Versão' }}
                </div>

                <center>
                    <form method="POST" action="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/versao/store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <input type="hidden" name="id_versao" value="{{ $versao->id_versao ?? '' }}">
                        <div>
                            <label>Arquivos</label>
                            <br>
                            <textarea name="arquivo" cols="50" rows="5">{{ $versao->arquivo ?? '' }}</textarea>
                        </div>
                        <div>
                            <label>SQL</label>
                            <br>
                            <textarea name="sql" cols="50" rows="5">{{ $versao->sql ?? '' }}</textarea>
                        </div>
                        <div>
                            <label>Scripts</label>
                            <br>
                            <textarea name="script" cols="50" rows="5">{{ $versao->script ?? '' }}</textarea>
                        </div>
                        <div>
                            <label>Incompatível com a anterior</label>
                            <br>
                            <select name="incompativel">
                                <option value="0">Não</option>
                                <option value="1" {{ isset($versao->incompativel) && $versao->incompativel == 1 ? 'selected' : '' }}>Sim</option>
                            </select>
                        </div>
                        <div>
                            <label>Implementação</label>
                            <br>
                            <select name="implementacao">
                                <option value="0">Não</option>
                                <option value="1" {{ isset($versao->implementacao) && $versao->implementacao == 1 ? 'selected' : '' }}>Sim</option>
                            </select>
                        </div>
                        <div>
                            <label>Descrição da Implementação</label>
                            <br>
                            <textarea name="descricao_implementacao" cols="50" rows="5">{{ $versao->descricao_implementacao ?? '' }}</textarea>
                        </div>
                        <div>
                            <label>Correção</label>
                            <br>
                            <select name="correcao">
                                <option value="0">Não</option>
                                <option value="1" {{ isset($versao->correcao) && $versao->correcao == 1 ? 'selected' : '' }}>Sim</option>
                            </select>
                        </div>
                        <div>
                            <label>Descrição da Correção</label>
                            <br>
                            <textarea name="descricao_correcao" cols="50" rows="5">{{ $versao->descricao_correcao ?? '' }}</textarea>
                        </div>
                        <div>
                            <label>Pré-Lancamento</label>
                            <br>
                            <select name="pre_lancamento">
                                <option value="0">Não</option>
                                <option value="1" {{ isset($versao->pre_lancamento) && $versao->pre_lancamento == 1 ? 'selected' : '' }}>Sim</option>
                            </select>
                        </div>
                        <div>
                            <label>Identificador</label>
                            <br>
                            <input type="text" name="identificador" value="{{ $versao->identificador ?? '' }}">
                        </div>
                        <div>
                            <a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/versao') }}">Voltar</a>
                            <button type="submit">Salvar</button>
                        </div>
                    </form>
                </center>
            </div>
        </div>
    </body>
</html>
