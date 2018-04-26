<?php

namespace Updater;

use Illuminate\Support\Facades\DB;

class Acl {

	/**
	 * Retorna um grupo de permissões
	 *
	 * @param string $grupo
	 * @return object
	 */
	public static function getGrupo(string $grupo)
	{
		return DB::table('acl_acao')->where('grupo', $grupo)->get();
	}

	/**
	 * Verifica se usuáŕio tem uma permissão
	 *
	 * @param int $id_usuario
	 * @param int $id_acl_acao
	 * @return boolean true or false
	 */
	public static function verifyPermission(int $id_acl_user, int $id_acl_acao)
	{
		$verify = DB::table('acl_users_acao')->where([
			['id_acl_acao', $id_acl_acao],
			['id_acl_user', $id_acl_user]
		])->count();
		return ($verify == 1) ? true : false;
	}
}
