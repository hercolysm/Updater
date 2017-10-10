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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', function () {
	return view('index');
});

Route::prefix('jogo_na_praia')->group( function () {

	Route::get('/', function () {
		return view('jogo_na_praia.index');
	});

	Route::get('/instalacao', function () {
		return view('jogo_na_praia.instalacao.index');
	});

	Route::get('/versoes', 'JogoNaPraiaController@index');

	Route::get('/versoes/create', 'JogoNaPraiaController@create');

	Route::get('/versoes/edit/{param1}', 'JogoNaPraiaController@edit');

	Route::post('/versoes/store', 'JogoNaPraiaController@store');

	Route::get('/documentacao', function () {
		return view('jogo_na_praia.documentacao.index');
	});

});
