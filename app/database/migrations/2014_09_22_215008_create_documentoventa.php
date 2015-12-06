<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentoventa extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documentoventa', function(Blueprint $table)
		{
			$table->boolean('estado');
			$table->decimal('descuento');
			$table->decimal('igv');
			$table->decimal('importe');
			$table->decimal('subtotal');
			$table->increments('id');
			$table->integer('caja_id')->unsigned();
			$table->integer('detallecaja_id')->unsigned();
			$table->integer('pedido_id')->unsigned();
			$table->integer('persona_id')->nullable();
			$table->integer('tipocomprobante_id');
			$table->string('numero')->nullable();
			$table->string('serie')->nullable();
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
		Schema::drop('documentoventa');
	}

}
