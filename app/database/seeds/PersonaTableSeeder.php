<?php

class PersonaTableSeeder extends Seeder {

	public function run()
	{
		$hotel = Hotel::create([
					'departamento'=>'Lambayeque', 
					'direccion'=>'Alfonso Ugarte #1234', 
					'nombre'=>'Hotel Alfonso Ugarte', 
					'provincia'=>'Chiclayo', 
					'razonsocial'=>'Hotel Alfonso Ugarte', 
					'ruc' =>2467890
				]);
		$persona = Persona::create([
						'nombre' => 'Administrador'
					]);

		Usuario::create([
			'hotel_id' =>$hotel->id, 
			'perfil_id' => 1, 
			'persona_id' => $persona->id, 
			'login'=>'Administrador', 
			'password' => \Hash::make(123456)
		]);
	}

}