<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsuario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('perfil', function(Blueprint $table2)
		{
			$table2->increments('id');
			$table2->string('descripcion');
			$table2->string('nombre');
			$table2->timestamps();
		});

		Schema::create('usuario', function(Blueprint $table)
		{
			$table->boolean('estado')->default(1);
			$table->foreign('hotel_id')->references('id')->on('hotel');
			$table->foreign('perfil_id')->references('id')->on('perfil');
			$table->foreign('persona_id')->references('id')->on('persona');
			$table->increments('id');
			$table->integer('hotel_id')->unsigned();
			$table->integer('perfil_id')->unsigned();
			$table->integer('persona_id')->unsigned();
			$table->string('login');
			$table->string('password');
			$table->string('remember_token');
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
		Schema::drop('perfil');
		Schema::drop('usuario');

	}

}
