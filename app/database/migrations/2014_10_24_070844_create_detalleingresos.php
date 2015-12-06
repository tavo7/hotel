<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetalleingresos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detalleingresos', function(Blueprint $table)
		{
			$table->decimal('importetotal', 10,2);
			$table->foreign('detallecaja_id')->references('id')->on('detallecaja');
			$table->increments('id');
			$table->integer('detallecaja_id')->unsigned();
			$table->string('descripcion');
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
		Schema::drop('detalleingresos');
	}

}
