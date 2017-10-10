<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Update - Jogo na Praia - Versões</title>

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
                margin-top: 80px;
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

            .m-b-md {
                margin-bottom: 30px;
            }

            .table-versoes > thead > tr > th {
                color: #636b6f;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                text-align: left;
            }

            .table-versoes > thead > tr > th {
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    Jogo na Praia -> Versões
                </div>

                <center>
                    <table class="table-versoes">
                        <thead>
                            <tr>
                                <th width="50%">Versão</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($versoes as $versao)
                                <tr>
                                    <td>{{ $versao }}</td>
                                    <td><a href="{{ url('/jogo_na_praia/versoes/edit/{1}') }}">Detalhes</a></td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"><a href="{{ url('/jogo_na_praia/versoes/create') }}">Nova Versão</a></td>
                            </tr>
                        </tbody>
                    </table>
                </center>
            </div>
        </div>
    </body>
</html>
