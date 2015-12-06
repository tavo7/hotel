<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHabitacion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipohabitacion', function(Blueprint $table2)
		{
			$table2->increments('id');
			$table2->string('descripcion');
			$table2->string('nombre');
			$table2->timestamps();
		});

		Schema::create('habitacion', function(Blueprint $table)
		{
			$table->enum('estado', ['Libre','Ocupada', 'Reservada', 'Limpieza', 'Deshabilitada','Sucia'])->default('Libre');;
			$table->foreign('piso_id')->references('id')->on('piso');
			$table->foreign('tipohabitacion_id')->references('id')->on('tipohabitacion');
			$table->increments('id');
			$table->integer('piso_id')->unsigned();
			$table->integer('tipohabitacion_id')->unsigned();
			$table->string('descripcion');
			$table->string('nombre');
			$table->timestamps();
		});

		Schema::create('preciohabitacion', function(Blueprint $table3)
		{
			$table3->increments('id');
			$table3->integer('habitacion_id')->unsigned();
			$table3->string('descripcion');
			$table3->decimal('precio', 10,2);
			$table3->foreign('habitacion_id')->references('id')->on('habitacion');
			$table3->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tipohabitacion');
		Schema::drop('habitacion');
		Schema::drop('preciohabitacion');
	}

}
