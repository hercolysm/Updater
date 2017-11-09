<?php

namespace Updater\Models;

use Illuminate\Database\Eloquent\Model;

class VersaoModel extends Model
{
    /**
     * The table associated with the Model.
     *
     * @var string
     */
    protected $table = 'versao';

    /**
     * Primary key of the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_versao';

    /**
     * 
     * @return string
     */
    public static function getVersao($id_aplicativo, $id_versao)
    {
        $anteriores = self::where('id_aplicativo', $id_aplicativo)
            ->where('id_versao', '<=', $id_versao)
            ->get();

        $maior = 0;
        $menor = 0;
        $correcao = 0;
        $identificador = "";

        foreach ($anteriores as $versao) {
            $correcao += $versao->correcao;

            if ($versao->implementacao) {
                $menor += $versao->implementacao;
                $correcao = 0;
            }

            if ($versao->incompativel) {
                $maior += $versao->incompativel;
                $menor = 0;
                $correcao = 0;
            }

            if ($versao->pre_lancamento && $versao->id_versao == $id_versao) {
                $identificador = '-' . $versao->identificador;
            }
        }

        return $maior . '.' . $menor . '.' . $correcao . $identificador;
    }

    /**
     * 
     * @return string
     */
    public static function getVersaoAtual($id_aplicativo)
    {
        $id_versao_atual = self::where('id_aplicativo', $id_aplicativo)->max('id_versao');

        return ($id_versao_atual) ? self::getVersao($id_aplicativo, $id_versao_atual) : '-';
    }

}
