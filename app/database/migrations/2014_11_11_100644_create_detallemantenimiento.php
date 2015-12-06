<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetallemantenimiento extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detallemantenimiento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('usuario_id')->unsigned();
			$table->integer('habitacion_id')->unsigned();
			$table->timestamp('horainicio');
			$table->timestamp('horatermino');
			$table->boolean('estado');
			$table->foreign('usuario_id')->references('id')->on('usuario');
			$table->foreign('habitacion_id')->references('id')->on('habitacion');
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
		Schema::drop('detallemantenimiento');
	}

}
