<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAclAcaoPermissao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acl_acao_permissao', function (Blueprint $table) {
            $table->increments('id_acl_acao_permissao');
            $table->integer('id_acl_acao')->unsigned();
            $table->integer('id_acl_permissao')->unsigned();
            $table->foreign('id_acl_acao')->references('id_acl_acao')->on('acl_acao');
            $table->foreign('id_acl_permissao')->references('id_acl_permissao')->on('acl_permissao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acl_acao_permissao');
    }
}
