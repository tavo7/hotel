<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePiso extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('piso', function(Blueprint $table)
		{
			$table->foreign('hotel_id')->references('id')->on('hotel');
			$table->increments('id');
			$table->integer('hotel_id')->unsigned();
			$table->string('alias');
			$table->string('descripcion');
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
		Schema::drop('piso');
	}

}
