<?php

namespace Updater\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Updater\Models\VersaoModel;

class VersaoController extends Controller
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
    public function index($id_aplicativo)
    {
        $aplicativo = DB::table('aplicativo')->where('id_aplicativo', $id_aplicativo)->first();
        $versoes = VersaoModel::where('id_aplicativo', $id_aplicativo)->orderBy('id_versao', 'desc')->get();
        $VersaoModel = new VersaoModel();

        return view('aplicativo.versao.index', [
            'aplicativo' => $aplicativo,
            'versoes' => $versoes,
            'VersaoModel' => $VersaoModel
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
        $versao = [
            'id_aplicativo' => $id_aplicativo,
            'incompativel' => $request->incompativel,
            'implementacao' => $request->implementacao,
            'correcao' => $request->correcao,
            'pre_lancamento' => $request->pre_lancamento,
            'identificador' => $request->identificador,
            'descricao_implementacao' => $request->descricao_implementacao,
            'descricao_correcao' => $request->descricao_correcao,
            'arquivo' => $request->arquivo,
            'sql' => $request->sql,
            'script' => $request->script,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if (!$request->id_versao) {
            $versao['created_at'] = date('Y-m-d H:i:s');
            $id_versao = DB::table('versao')->insertGetId($versao);
        } else {
            DB::table('versao')->where('id_versao', $request->id_versao)->update($versao);
            $id_versao = $request->id_versao;
        }

        if ($request->gerar_arquivo) {
            self::gerarArquivo($id_aplicativo, $id_versao);
        }

        if ($request->enviar_arquivo) {
            self::enviarArquivo($id_aplicativo, $id_versao);
        }

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

    /**
     * Gera arquivo e redireciona
     *
     * @param  int  $id_aplicativo
     * @param  int  $id_versao
     * @return \Illuminate\Http\Response
     */
    public function gerar($id_aplicativo, $id_versao)
    {
        self::gerarArquivo($id_aplicativo, $id_versao);

        return redirect('/aplicativo/'.$id_aplicativo.'/versao');
    }

    /**
     * Envia arquivo e redireciona
     *
     * @param  int  $id_aplicativo
     * @param  int  $id_versao
     * @return \Illuminate\Http\Response
     */
    public function enviar($id_aplicativo, $id_versao)
    {
        self::enviarArquivo($id_aplicativo, $id_versao);

        return redirect('/aplicativo/'.$id_aplicativo.'/versao');
    }

    /**
     * Gera arquivo .tar.gz com as modificações da versão
     *
     * @param int $id_aplicativo
     * @param int $id_versao
     * @return \Illuminate\Http\Response
     */
    protected static function gerarArquivo($id_aplicativo, $id_versao)
    {
        $aplicativo = DB::table('aplicativo')->where('id_aplicativo', $id_aplicativo)->first();
        $versao = VersaoModel::find($id_versao);

        $aplicativo_none = str_replace(' ', '_', strtolower($aplicativo->nome));
        $desenvolvimento = $aplicativo->desenvolvimento;
        $temp_dir = sys_get_temp_dir();
     
        $pasta_temp = $temp_dir. '/' .base64_encode($id_versao);

        if (self::criar_novo_diretorio($pasta_temp)) {

            if ($versao->sql) {

                self::criar_novo_arquivo($pasta_temp.'/sql.sql');

                $file = fopen($pasta_temp.'/sql.sql', 'w') or die("Erro ao abrir o arquivo sql!");
                fwrite($file, $versao->sql);
                fclose($file);
            }

            if ($versao->script) {

                self::criar_novo_arquivo($pasta_temp.'/script.sh');

                $file = fopen($pasta_temp.'/script.sh', 'w') or die("Erro ao abrir o arquivo script!");
                fwrite($file, $versao->script);
                fclose($file);
            }

            if ($versao->arquivo) {

                self::criar_novo_diretorio($pasta_temp.'/arquivo');
                
                $arquivos = explode("\r\n", $versao->arquivo);

                foreach ($arquivos as $key => $value) {
                    exec('cp -r '.$desenvolvimento.'/'.$value .' '.$pasta_temp.'/arquivo');
                }
            }

            if ($versao->sql || $versao->script || $versao->arquivo) {

                $storage_app = __DIR__.'/../../../storage/app/'.$aplicativo_none;

                if (!file_exists($storage_app)) {
                    exec('mkdir '.$storage_app);
                    exec('chmod 656 '.$storage_app);
                }

                $versao_nome = VersaoModel::getVersao($id_aplicativo, $id_versao);
                $arquivo_tar = $aplicativo_none.'_v'.$versao_nome.'.tar';

                exec('tar -cf '.$storage_app.'/'.$arquivo_tar.' '.$pasta_temp.'/*');
                exec('gzip -9f '.$storage_app.'/'.$arquivo_tar);

                $versao->arquivo_gerado = 1;
                $versao->arquivo_nome = $arquivo_tar.'.gz';
                $versao->save();
            }
        }
    }

    /**
     * Cria um novo arquivo vazio
     *
     * Se arquivo já existir, exclui e cria novamente.
     *
     * @return boolean
     */
    protected static function criar_novo_arquivo($nome_arquivo) {
        if (file_exists($nome_arquivo)) {
            unlink($nome_arquivo);
        }
        return touch($nome_arquivo);
    }

    /**
     * Cria um novo diretório vazio
     *
     * Se diretório já existir, exclui e cria novamente.
     *
     * @return boolean
     */
    protected static function criar_novo_diretorio($nome_diretorio) {
        if (file_exists($nome_diretorio)) {
            self::excluir_recursivo($nome_diretorio);
        }
        return mkdir($nome_diretorio);
    }

    /**
     * Excluir de modo recursivo um diretório
     *
     * @return void
     */
    protected static function excluir_recursivo($nome_diretorio) {
        $conteudo = scandir($nome_diretorio);
        if ($conteudo) {
            foreach ($conteudo as $value) {
                if (!in_array($value, array('.', '..'))) {
                    $caminho = $nome_diretorio. '/' .$value;
                    if (!is_dir($caminho)) {
                        unlink($caminho);
                    }
                    else {
                        self::excluir_recursivo($caminho);
                    }
                }
            }
            rmdir($nome_diretorio);
        }
    }

    /**
     * Enviar arquivo .tar.gz com as modificações da versão para o servidor de produção
     *
     * @param int $id_aplicativo
     * @param int $id_versao
     * @return \Illuminate\Http\Response
     */
    protected static function enviarArquivo($id_aplicativo, $id_versao)
    {
        $aplicativo = DB::table('aplicativo')->where('id_aplicativo', $id_aplicativo)->first();
        $versao = VersaoModel::find($id_versao);

        if (!$versao->arquivo_gerado) {
            self::gerarArquivo($id_aplicativo, $id_versao);
        }

        $aplicativo_none = str_replace(' ', '_', strtolower($aplicativo->nome));
        
        $storage_local = __DIR__.'/../../../storage/app/'.$aplicativo_none;
        $storage_servidor = "/opt/updater/". $aplicativo_none ."/versoes/";
        
        $versao_nome = VersaoModel::getVersao($id_aplicativo, $id_versao);
        $arquivo_nome = $aplicativo_none.'_v'.$versao_nome.'.tar.gz';

        $arquivo_tar = $storage_local .'/'. $arquivo_nome;

        if (file_exists($arquivo_tar)) {
            exec("sudo ssh root@192.168.56.10 \"mkdir -p ". $storage_servidor ."\"");
            exec("sudo scp ". $arquivo_tar ." root@192.168.56.10:".$storage_servidor);
            $versao->arquivo_enviado = 1;
            $versao->data_envio = date('Y-m-d H:i:s');
            $versao->save();
        }

    }

}
