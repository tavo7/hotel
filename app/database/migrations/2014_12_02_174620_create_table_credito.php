<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTableCredito extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('table_credito', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('pedido_id')->unsigned();
            $table->integer('detallecaja_id')->unsigned();
            $table->smallInteger('estado');
            $table->decimal('importe');
            $table->string('nombre');
            $table->string('dni');
            $table->string('empresa');
            $table->string('ruc');
            $table->foreign('pedido_id')->references('id')->on('pedido');
            $table->foreign('detallecaja_id')->references('id')->on('pedido');
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
		Schema::drop('table_credito');
	}

}
