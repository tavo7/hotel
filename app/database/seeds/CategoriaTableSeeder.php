<?php

class CategoriaTableSeeder extends Seeder {

	public function run()
	{
		Categoria::create([
			'descripcion'=>'productos de consumo interno', 
			'nombre' =>'productosinterno'
		]);
	}

}