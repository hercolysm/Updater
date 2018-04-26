<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('index');
});

Route::get('/home', function () {
	return view('index');
});

Auth::routes();

Route::get('/sobre', 'IndexController@sobre');

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/aplicativo', 'AplicativoController@index');

Route::get('/aplicativo/create', function () {
	return view('aplicativo.create-edit');
});

Route::get('/aplicativo/edit/{id_aplicativo}', 'AplicativoController@edit');

Route::post('/aplicativo/store', 'AplicativoController@store');

Route::get('/aplicativo/destroy/{id_aplicativo}', 'AplicativoController@destroy');

Route::get('/aplicativo/{id_aplicativo}', 'AplicativoController@show');

Route::get('/aplicativo/{id_aplicativo}/instalacao', 'InstalacaoController@index');

Route::get('/aplicativo/{id_aplicativo}/documentacao', 'DocumantacaoController@index');

Route::get('/aplicativo/{id_aplicativo}/versao', 'VersaoController@index');

Route::get('/aplicativo/{id_aplicativo}/versao/create', 'VersaoController@create');

Route::get('/aplicativo/{id_aplicativo}/versao/edit/{id_versao}', 'VersaoController@edit');

Route::post('/aplicativo/{id_aplicativo}/versao/store', 'VersaoController@store');

Route::get('/aplicativo/{id_aplicativo}/versao/destroy/{id_versao}', 'VersaoController@destroy');

Route::get('/aplicativo/{id_aplicativo}/versao/gerar/{id_versao}', 'VersaoController@gerar');

Route::get('/aplicativo/{id_aplicativo}/versao/enviar/{id_versao}', 'VersaoController@enviar');

Route::get('/aplicativo/{id_aplicativo}/sobre', 'AplicativoController@sobre');

Route::get('/usuario', 'UsuarioController@index');

Route::get('/usuario/create', 'UsuarioController@create');

Route::get('/usuario/edit/{id_usuario}', 'UsuarioController@edit');

Route::post('/usuario/store', 'UsuarioController@store');

Route::get('/usuario/destroy/{id}', 'UsuarioController@destroy');
