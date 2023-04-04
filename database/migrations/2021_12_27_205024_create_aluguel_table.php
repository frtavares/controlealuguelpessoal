<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAluguelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aluguel', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('status');
            $table->integer('client_id');
            $table->string('referencia');
            $table->string('vencimento');
            $table->decimal('valor', 11,2);
            $table->decimal('desconto', 11,2);
            $table->string('deferenciadesconto');
            $table->decimal('condominio', 11,2);
            $table->string('referenciacondominio');
            $table->decimal('taxaextra', 11,2);
            $table->string('referenciataxa');
            $table->decimal('totaltesconto', 11,2);
            $table->decimal('subtotal', 11,2);
            $table->text('observacoes');
            $table->softDeletes();
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
        Schema::dropIfExists('aluguel');
    }
}
