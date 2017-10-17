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
