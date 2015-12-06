<?php

class Documentoventa extends \Eloquent {
	protected $table = 'documentoventa';
	protected $fillable = ['estado', 'descuento' , 'igv' , 'importe' , 'subtotal' , 'caja_id' ,
							'detallecaja_id' , 	'pedido_id' , 	'persona_id' , 	'tipocomprobante_id',
							'numero', 'serie' ];

	public function productos()
	{
		return $this->belongsToMany('Producto', 'detalledocumentoventa', 'documentoventa_id', 'producto_id')
				->withPivot('descuento', 'precio', 'preciounitario', 'cantidad' , 'descripcion');
	}

	public function alquiler()
	{
		return $this->belongsToMany('PrecioHabitacion', 'detalledocumentoventa', 'documentoventa_id', 'preciohabitacion_id')
				->withPivot('descuento', 'precio', 'preciounitario', 'cantidad' ,'descripcion');
	}

    public function pedido(){
        return $this->belongsTo('Pedido', 'pedido_id');
    }
}