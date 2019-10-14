<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerbaIndenizatoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verbas_indenizatorias', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_deputado');
            $table->string('data_referencia');
            $table->integer('cod_tipo_despesa');
            $table->string('valor', 20);
            $table->string('descricao_tipo_despesa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('verba_indenizatorias');
    }
}
