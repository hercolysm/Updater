<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Update - Novo Aplicativo</title>

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
                    Cadastro
                </div>

                <center>
                    <form method="POST" action="{{ url('/aplicativo/store') }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                        <input type="hidden" name="id_aplicativo" value="{{ $aplicativo->id_aplicativo ?? '' }}">
                        <div>
                            <label>Nome</label>
                            <br>
                            <input type="text" name="nome" value="{{ $aplicativo->nome ?? '' }}" required="required">
                        </div>
                         <div>
                            <label>Descrição</label>
                            <br>
                            <input type="text" name="descricao" value="{{ $aplicativo->descricao ?? '' }}" required="required">
                        </div>
                        <div>
                            <label>GitHub</label>
                            <br>
                            <input type="text" name="github" value="{{ $aplicativo->github ?? '' }}">
                        </div>
                        <div>
                            <label>GitLab</label>
                            <br>
                            <input type="text" name="gitlab" value="{{ $aplicativo->gitlab ?? '' }}">
                        </div>
                        <div>
                            <label>Desenvolvimento</label>
                            <br>
                            <input type="text" name="desenvolvimento" value="{{ $aplicativo->desenvolvimento ?? '' }}">
                        </div>
                        <div>
                            <label>Produção</label>
                            <br>
                            <input type="text" name="producao" value="{{ $aplicativo->producao ?? '' }}">
                        </div>
                        <div>
                            <label>Backup</label>
                            <br>
                            <input type="text" name="backup" value="{{ $aplicativo->backup ?? '' }}">
                        </div>
                        <div>
                            <a href="{{ url('/aplicativo') }}">Voltar</a>
                            <button type="submit">Salvar</button>
                        </div>
                    </form>
                </center>
            </div>
        </div>
    </body>
</html>
