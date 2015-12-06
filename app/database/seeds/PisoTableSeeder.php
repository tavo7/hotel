<?php


class PisoTableSeeder extends Seeder {

	public function run()
	{
		for ($i=1; $i < 6 ; $i++) { 
			Piso::create([
				'hotel_id'=>1, 
				'alias'=>'P'.$i, 
				'descripcion'=>'Piso '.$i, 
				'nombre'=>'Piso '.$i, 
			]);
		}
	}

}