<?php

namespace Updater\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Updater\Models\UsuarioModel;
use Updater\Acl;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista = DB::table('users')->get();
        return view('usuario.index', ['lista' => $lista]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuario.create-edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('id')) {
            $usuario = UsuarioModel::find($request->input('id'));
        } else {
            $usuario = new UsuarioModel();
        }

        $usuario->name = $request->input('name');
        $usuario->email = $request->input('email');

        if ($request->input('password')) {
            $usuario->password = bcrypt($request->input('password'));
        }

        $usuario->save();
        
        $id = $usuario->id;

        DB::table('acl_users_acao')->where('id_acl_user', $id)->delete();

        if (is_array($request->acl_acao)) {
            foreach ($request->acl_acao as $id_acl_acao) {
                DB::table('acl_users_acao')->insert(['id_acl_user' => $id, 'id_acl_acao' => $id_acl_acao]);
            }
        }

        return redirect('/usuario');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = UsuarioModel::find($id);
        $tabs = ['aplicativos' => 'Aplicativos', 'documentacao' => 'Documentação', 'usuarios' => 'Usuários', 'configuracoes' => 'Configurações'];
        $Acl = new Acl();

        return view('usuario.create-edit', ['usuario' => $usuario, 'tabs' => $tabs, 'Acl' => $Acl]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuario = UsuarioModel::find($id);
        $usuario->delete();

        return redirect('/usuario');
    }
}
