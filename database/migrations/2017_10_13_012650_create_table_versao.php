<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVersao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('versao', function (Blueprint $table) {
            $table->increments('id_versao');
            $table->integer('id_aplicativo')->unsigned();
            $table->boolean('incompativel')->default(0);
            $table->boolean('implementacao')->default(0);
            $table->boolean('correcao')->default(0);
            $table->boolean('pre_lancamento')->default(0);
            $table->string('identificador')->nullable();
            $table->text('descricao_implementacao')->nullable();
            $table->text('descricao_correcao')->nullable();
            $table->text('arquivo')->nullable();
            $table->text('sql')->nullable();
            $table->text('script')->nullable();
            $table->timestamps();
            $table->boolean('arquivo_gerado')->default(0);
            $table->string('arquivo_nome')->nullable();
            $table->boolean('arquivo_enviado')->default(0);
            $table->dateTime('data_envio')->nullable();
            $table->foreign('id_aplicativo')->references('id_aplicativo')->on('aplicativo')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('versao');
    }
}
