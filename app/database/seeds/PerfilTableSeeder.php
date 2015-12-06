<?php

class PerfilTableSeeder extends Seeder {

	public function run()
	{
		Perfil::create([
			'descripcion'=>"Administrador del Sistema", 
			'nombre' => "Administrador"
		]);
		Perfil::create([
			'descripcion'=>"Encargado de Caja", 
			'nombre' => "Cajero"
		]);
		Perfil::create([
			'descripcion'=>"Empleado de Limpieza", 
			'nombre' => "Limpieza"
		]);
	}

}