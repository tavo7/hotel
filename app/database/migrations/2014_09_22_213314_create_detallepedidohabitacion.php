<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetallepedidohabitacion extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('detallepedidohabitacion', function(Blueprint $table)
		{
			$table->boolean('estado')->default(0);
			$table->decimal('precio', 10,2);
			$table->enum('control', ['dia', 'hora', '4horas', 'ninguno']);
			$table->foreign('pedido_id')->references('id')->on('pedido');
			$table->foreign('preciohabitacion_id')->references('id')->on('preciohabitacion');
			$table->increments('id');
			$table->integer('cantidad');
			$table->integer('pedido_id')->unsigned();
			$table->integer('preciohabitacion_id')->unsigned();
			$table->string('descripcion');
			$table->string('motivo');
			$table->timestamp('fechacontrol');
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
		Schema::drop('detallepedidohabitacion');
	}

}
