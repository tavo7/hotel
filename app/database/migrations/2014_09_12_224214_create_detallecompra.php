<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetallecompra extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detallecompra', function(Blueprint $table)
		{
			$table->decimal ('preciocompra',10,2);
			$table->decimal('cantidad',10,2);
			$table->decimal('cantidadtotal',10,2);
			$table->decimal('preciototal',10,2);
			$table->decimal('preciounitario',10,2);
			$table->decimal('presentacion',10,2);
			$table->foreign('compra_id')->references('id')->on('compra');
			$table->foreign('producto_id')->references('id')->on('producto');
			$table->increments('id');
			$table->integer('compra_id')->unsigned();
			$table->integer('producto_id')->unsigned();
			$table->string('unidadmedida');
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
		Schema::drop('detallecompra');
	}

}
