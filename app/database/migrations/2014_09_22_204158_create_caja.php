<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCaja extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('caja', function(Blueprint $table)
		{
			$table->boolean('estado')->default(1);
			$table->increments('id');
			$table->integer('hotel_id')->unsigned();
			$table->foreign('hotel_id')->references('id')->on('hotel');
			$table->string('impresora')->nullable();
			$table->string('nombre');
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
		Schema::drop('caja');
	}

}
