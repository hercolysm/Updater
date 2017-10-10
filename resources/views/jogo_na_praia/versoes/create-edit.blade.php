<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Update - Jogo na Praia - Nova Versão</title>

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
                    Jogo na Praia -> Nova Versão
                </div>

                <center>
                    <form method="POST" action="{{ url('/jogo_na_praia/versoes/store') }}">
                         <input type="hidden" name="_token" value="{{ csrf_token() }}" >
                         <div>
                            <label>Descrição</label>
                            <br>
                            <textarea name="descricao" cols="50" rows="5"></textarea>
                        </div>
                        <div>
                            <label>Arquivos</label>
                            <br>
                            <textarea name="arquivos" cols="50" rows="5"></textarea>
                        </div>
                        <div>
                            <label>SQL</label>
                            <br>
                            <textarea name="sql" cols="50" rows="5"></textarea>
                        </div>
                        <div>
                            <label>Scripts</label>
                            <br>
                            <textarea name="scripts" cols="50" rows="5"></textarea>
                        </div>
                        <div>
                            <a href="{{ url('/jogo_na_praia/versoes') }}">Voltar</a>
                            <button type="submit">Salvar</button>
                        </div>
                    </form>
                </center>
            </div>
        </div>
    </body>
</html>
