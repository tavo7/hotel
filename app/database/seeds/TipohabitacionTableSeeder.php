<?php


class TipohabitacionTableSeeder extends Seeder {

	public function run()
	{

			Tipohabitacion::create([
				'nombre'=>'Simple',
				'descripcion'=>'Simple'
			]);
			Tipohabitacion::create([
				'nombre'=>'Doble',
				'descripcion'=>'Doble'
			]);
			Tipohabitacion::create([
				'nombre'=>'Triple',
				'descripcion'=>'Triple'
			]);
			Tipohabitacion::create([
				'nombre'=>'Matrimonial',
				'descripcion'=>'Matrimonial'
			]);
	}

}