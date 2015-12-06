<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersona extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('persona', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('departamento')->nullable();
			$table->string('direccion')->nullable();
			$table->string('distrito')->nullable();
			$table->string('dni')->nullable();
			$table->string('nombre')->nullable();
			$table->string('provincia')->nullable();
			$table->string('razonsocial')->nullable();
			$table->string('ruc')->nullable();
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
		Schema::drop('persona');
	}

}
