@extends('layouts.lista')

@section('title', ' - Sobre')

@section('titulo_principal', $aplicativo->nome)

@section('content')
	<a href="{{ url('/aplicativo/' . $aplicativo->id_aplicativo) }}" class="pull-left">Voltar</a>
	<br>
	@if($file)
	<pre>
		@while(!feof($file))
			{{ fgets($file) }}
		@endwhile
	</pre>
	@else
		<center>Arquivo não encontrado, adicione um arquivo README.md no projeto</center>
	@endif
@endsection