<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProducto extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('producto', function(Blueprint $table)
		{
			$table->boolean('estado')->default(1);
			$table->decimal('costo');
			$table->decimal('precioventa', 10, 2);
			$table->decimal('stockactual',10, 2);
			$table->decimal('stockmaximo',10, 2);
			$table->decimal('stockminimo',10, 2);
			$table->foreign('categoria_id')->references('id')->on('categoria');
			$table->foreign('unidadmedida_id')->references('id')->on('unidadmedida');
			$table->increments('id');
			$table->integer('categoria_id')->unsigned();
			$table->integer('unidadmedida_id')->unsigned();
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
		Schema::drop('producto');
	}

}
