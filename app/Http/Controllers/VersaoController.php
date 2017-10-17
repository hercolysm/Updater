<?php

namespace Updater\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Updater\Models\VersaoModel;

class VersaoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id_aplicativo)
    {
        $aplicativo = DB::table('aplicativo')->where('id_aplicativo', $id_aplicativo)->first();
        $versoes = VersaoModel::where('id_aplicativo', $id_aplicativo)->get();

        return view('aplicativo.versao.index', [
            'aplicativo' => $aplicativo,
            'versoes' => $versoes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_aplicativo)
    {
        $aplicativo = DB::table('aplicativo')->where('id_aplicativo', $id_aplicativo)->first();

        return view('aplicativo.versao.create-edit', ['aplicativo' => $aplicativo]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id_aplicativo)
    {
        if (!$request->id_versao) {
            $versao = new VersaoModel();
        } else {
            $versao = VersaoModel::find($request->id_versao);
        }

        $versao->id_aplicativo = $id_aplicativo;
        $versao->incompativel = $request->incompativel;
        $versao->implementacao = $request->implementacao;
        $versao->correcao = $request->correcao;
        $versao->pre_lancamento = $request->pre_lancamento;
        $versao->identificador = $request->identificador;
        $versao->descricao_implementacao = $request->descricao_implementacao;
        $versao->descricao_correcao = $request->descricao_correcao;
        $versao->arquivo = $request->arquivo;
        $versao->sql = $request->sql;
        $versao->script = $request->script;

        $versao->save();

        return redirect('/aplicativo/'.$id_aplicativo.'/versao');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id_versao
     * @return \Illuminate\Http\Response
     */
    public function show($id_versao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id_versao
     * @return \Illuminate\Http\Response
     */
    public function edit($id_aplicativo, $id_versao)
    {
        $aplicativo = DB::table('aplicativo')->where('id_aplicativo', $id_aplicativo)->first();
        $versao = VersaoModel::find($id_versao);
        
        return view('aplicativo.versao.create-edit', ['aplicativo' => $aplicativo, 'versao' => $versao]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id_versao
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_versao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id_versao
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_aplicativo, $id_versao)
    {
        VersaoModel::destroy($id_versao);

        return redirect('/aplicativo/'.$id_aplicativo.'/versao');
    }
}