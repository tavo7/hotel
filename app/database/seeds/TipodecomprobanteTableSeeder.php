<?php
class TipodecomprobanteTableSeeder extends Seeder {

	public function run()
	{
		Tipodecomprobante::create([
			'descripcion'=>'No se registra comprobante', 	
			'nombre'=>'Sin Comprobante'
		]);

		Tipodecomprobante::create([
			'descripcion'=>'Boleta', 	
			'nombre'=>'Boleta'
		]);

		Tipodecomprobante::create([
			'descripcion'=>'Factura', 	
			'nombre'=>'Factura'
		]);
	}
}