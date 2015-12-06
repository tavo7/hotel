<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetallepedidoproductos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detallepedidoproductos', function(Blueprint $table)
		{
			$table->boolean('estado')->default(0);
			$table->decimal('precio', 10,2);
			$table->decimal('preciounitario', 10,2);
			$table->foreign('pedido_id')->references('id')->on('pedido');
			$table->foreign('producto_id')->references('id')->on('producto');
			$table->increments('id');
			$table->integer('cantidad')->unsigned();
			$table->integer('pedido_id')->unsigned();
			$table->integer('producto_id')->unsigned();
			$table->string('motivo');
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
		Schema::drop('detallepedidoproductos');
	}

}
