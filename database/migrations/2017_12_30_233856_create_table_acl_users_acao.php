<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAclUsersAcao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acl_users_acao', function (Blueprint $table) {
            $table->increments('id_acl_user_acao');
            $table->integer('id_acl_user')->unsigned();
            $table->integer('id_acl_acao')->unsigned();
            $table->foreign('id_acl_user')->references('id')->on('users');
            $table->foreign('id_acl_acao')->references('id_acl_acao')->on('acl_acao');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('acl_users_acao');
    }
}
