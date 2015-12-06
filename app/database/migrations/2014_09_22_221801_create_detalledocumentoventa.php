<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetalledocumentoventa extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detalledocumentoventa', function(Blueprint $table)
		{
			$table->decimal('descuento');
			$table->decimal('precio');
			$table->decimal('preciounitario');
			$table->foreign('documentoventa_id')->references('id')->on('documentoventa');
			$table->foreign('preciohabitacion_id')->references('id')->on('preciohabitacion');
			$table->foreign('producto_id')->references('id')->on('producto');
			$table->increments('id');
			$table->integer('cantidad');
			$table->integer('documentoventa_id')->unsigned();
			$table->integer('preciohabitacion_id')->nullable()->unsigned();
			$table->integer('producto_id')->nullable()->unsigned();
			$table->string('descripcion');
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
		Schema::drop('detalledocumentoventa');
	}

}
