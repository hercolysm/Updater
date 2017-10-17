<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Updater - {{ $aplicativo->nome }} - Versões</title>

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

            .table-aplicativos > thead > tr > th {
                color: #636b6f;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                text-align: left;
            }

            .table-aplicativos > thead > tr > th {
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{ $aplicativo->nome }}
                </div>

                <center>
                    <table class="table-aplicativos">
                        <thead>
                            <tr>
                                <th width="50%">Versões</th>
                                <th width="20%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($versoes as $versao)
                                <tr>
                                    <td>{{ $versao->id_versao }}</td>
                                    <td>
                                        <a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/versao/edit/'. $versao->id_versao) }}">Editar</a>
                                        <a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/versao/destroy/'. $versao->id_versao) }}">Excluir</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2">Nenhuma versão encontrada</td>
                                </tr>
                            @endforelse
                            <tr>
                                <td colspan="2">
                                    <a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo) }}">Voltar</a>
                                    <a href="{{ url('/aplicativo/'. $aplicativo->id_aplicativo .'/versao/create') }}">Nova Versão</a></td>
                            </tr>
                        </tbody>
                    </table>
                </center>
            </div>
        </div>
    </body>
</html>
