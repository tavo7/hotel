<?php

class CajaTableSeeder extends Seeder {

	public function run()
	{
			Caja::create([
				'nombre'=>'Caja',
				'hotel_id'=>1,
			]);
	}

}