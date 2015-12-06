<?php

class UnidadmedidaTableSeeder extends Seeder {

	public function run()
	{
		Unidadmedida::create([
			'alias' => 'Un',
			'nombre'=> 'Unidades'
		]);
	}

}