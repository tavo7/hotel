<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetallecaja extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detallecaja', function(Blueprint $table)
		{
			$table->decimal('arqueo', 10,2);
			$table->decimal('diferencia', 10,2);
			$table->decimal('gastos', 10,2);
			$table->decimal('ingresos', 10,2);
			$table->decimal('montoinicial',10,2);
			$table->decimal('ventas', 10,2);
			$table->foreign('caja_id')->references('id')->on('caja');
			$table->foreign('usuario_id')->references('id')->on('usuario');
			$table->increments('id');
			$table->integer('caja_id')->unsigned();
			$table->integer('usuario_id')->unsigned();
			$table->timestamp('fechacierre');
			$table->timestamp('fechainicio');
			$table->enum('estado', ['Abierto', 'Cerrado']);
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
		Schema::drop('detallecaja');
	}

}
