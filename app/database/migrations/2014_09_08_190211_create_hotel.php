<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHotel extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('hotel', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('departamento');
			$table->string('direccion');
			$table->string('foto');
			$table->string('nombre');
			$table->string('provincia');
			$table->string('razonsocial');
			$table->string('ruc');
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
		Schema::drop('hotel');
	}

}
