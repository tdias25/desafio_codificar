<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVerbaDetalhadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verbas_indenizatorias_despesas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_item');
            $table->integer('id_verba_indenizatoria');
            $table->string('valor_reembolsado');
            $table->string('data_emissao');
            $table->string('cpf_cnpj');
            $table->string('valor_despesa', 20);
            $table->string('nome_emitente');
            $table->string('descricao_documento', 30);
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
        Schema::dropIfExists('verbas_indenizatorias_itens');
    }
}
