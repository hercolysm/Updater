<?php

namespace Updater\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Updater\Models\VersaoModel;

class AplicativoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista = DB::table('aplicativo')->get();
        $VersaoModel = new VersaoModel();

        return view('aplicativo.index', ['lista' => $lista, 'VersaoModel' => $VersaoModel]);
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
        $desenvolvimento = $request->input('desenvolvimento');
        $producao = $request->input('producao');
        $backup = $request->input('backup');
        $date = date('Y-m-d H:i:s');

        $aplicativo = [
            'nome' => $nome, 
            'descricao' => $descricao, 
            'github' => $github, 
            'gitlab' => $gitlab, 
            'desenvolvimento' => $desenvolvimento,
            'producao' => $producao,
            'backup' => $backup,
            'updated_at' => $date
        ];

        if (!$id_aplicativo) {
            $aplicativo['created_at'] = $date;
            DB::table('aplicativo')->insert($aplicativo);

            self::destroy_storage($nome);
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
        $aplicativo = DB::table('aplicativo')->where('id_aplicativo', $id_aplicativo)->first();

        self::destroy_storage($aplicativo->nome);

        DB::table('aplicativo')->where('id_aplicativo', $id_aplicativo)->delete();

        return redirect('/aplicativo');
    }

    /**
     * Remove arquivos do aplicativos
     *
     * @param string $aplicativo_nome
     * @return void
     */
    public function destroy_storage($aplicativo_none)
    {
        $app_nome = str_replace(' ', '_', strtolower($aplicativo_none));
        exec("sudo rm -rf " . $_SERVER['DOCUMENT_ROOT'] . '/../storage/app/' . $app_nome);
    }

    /**
     *
     *
     *
     *
     */
    public function sobre($id_aplicativo)
    {
        $aplicativo = DB::table('aplicativo')->where('id_aplicativo', $id_aplicativo)->first();
        $readme = $aplicativo->desenvolvimento . '/README.md';

        if (file_exists($readme)) {
            $file = fopen($readme, 'r');
        }
        else {
            $file = false;
        }

        return view('aplicativo.sobre', ['aplicativo' => $aplicativo, 'file' => $file]);
    }
}
