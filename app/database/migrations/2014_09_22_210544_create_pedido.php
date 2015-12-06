<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePedido extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pedido', function(Blueprint $table)
		{
			$table->integer('habitacion_id')->unsigned()->nullable();
			$table->integer('usuario_id')->unsigned();
			$table->boolean('estado');
			$table->foreign('habitacion_id')->references('id')->on('habitacion');
			$table->foreign('usuario_id')->references('id')->on('usuario');
			$table->increments('id');
			$table->string('html5date');
			$table->timestamp('fechacancelacion');
			$table->timestamp('fechafin');
			$table->timestamp('fechainicio');
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
		Schema::drop('pedido');
	}

}
