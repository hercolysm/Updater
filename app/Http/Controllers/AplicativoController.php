<?php

namespace Updater\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AplicativoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista = DB::table('aplicativo')->get();

        return view('aplicativo.index', ['lista' => $lista]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jogo_na_praia.versoes.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_aplicativo = $request->input('id_aplicativo');
        $nome = $request->input('nome');
        $descricao = $request->input('descricao');
        $github = $request->input('github');
        $gitlab = $request->input('gitlab');

        $aplicativo = ['nome' => $nome, 'descricao' => $descricao, 'github' => $github, 'gitlab' => $gitlab];

        if (!$id_aplicativo) {
            DB::table('aplicativo')->insert($aplicativo);
        } else {
            DB::table('aplicativo')->where('id_aplicativo', $id_aplicativo)->update($aplicativo);
        }

        return redirect('/aplicativo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_aplicativo
     * @return \Illuminate\Http\Response
     */
    public function show($id_aplicativo)
    {
        $aplicativo = DB::table('aplicativo')->where('id_aplicativo', $id_aplicativo)->first();

        return view('aplicativo.aplicativo', ['aplicativo' => $aplicativo]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_aplicativo
     * @return \Illuminate\Http\Response
     */
    public function edit($id_aplicativo)
    {
        $aplicativo = DB::table('aplicativo')->where('id_aplicativo', $id_aplicativo)->first();

        return view('aplicativo.create-edit', ['aplicativo' => $aplicativo]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_aplicativo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_aplicativo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_aplicativo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_aplicativo)
    {
        //
        DB::table('aplicativo')->where('id_aplicativo', $id_aplicativo)->delete();

        return redirect('/aplicativo');
    }
}
