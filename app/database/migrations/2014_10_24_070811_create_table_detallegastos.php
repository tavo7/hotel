<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableDetallegastos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipodegasto', function(Blueprint $table2)
		{
			$table2->increments('id');
			$table2->string('nombre');
			$table2->timestamps();
		});

		Schema::create('detallegastos', function(Blueprint $table)
		{
			$table->decimal('igv', 10,2)->nullable();
			$table->decimal('importetotal', 10,2);
			$table->decimal('subtotal', 10,2)->nullable();
			$table->foreign('detallecaja_id')->references('id')->on('detallecaja');
			$table->foreign('tipogasto_id')->references('id')->on('tipodegasto');
			$table->increments('id');
			$table->integer('detallecaja_id')->unsigned()->nullable();
			$table->integer('tipogasto_id')->unsigned();
			$table->string('descripcion')->nullable();
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
		Schema::drop('table_detallegastos');
	}

}
