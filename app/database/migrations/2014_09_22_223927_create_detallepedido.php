<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetallepedido extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('detallepedido', function (Blueprint $table) {
				$table->foreign('pedido_id')->references('id')->on('pedido');
				$table->foreign('persona_id')->references('id')->on('persona');
				$table->increments('id');
				$table->integer('numerodehuespedes');
				$table->integer('pedido_id')->unsigned();
				$table->integer('persona_id')->unsigned();
				$table->timestamp('fechaentrada');
				$table->timestamp('fechasalida');
				$table->timestamps();
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('detallepedido');
	}

}
