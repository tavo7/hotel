<?php

class Compras extends \Eloquent {
	protected $table = 'compra';
	protected $guarded = array();
	protected $fillable = array('igv' , 'subtotal' , 'total' , 	'provedor_id' ,
						'tipocomprobante_id' ,'fecha', 'usuario_id', 'numero', 'serie');
	public static $rules = array();

	public function tipocomprobante(){
		return $this->belongsTo('Tipodecomprobante', 'tipocomprobante_id');
	}

	public function provedor(){
		return $this->belongsTo('Persona', 'provedor_id');
	}

	public function productos(){
        return $this->belongsToMany('Producto', 'detallecompra', 'compra_id', 'producto_id')
                        ->withPivot('preciocompra' ,'cantidad' , 'cantidadtotal' ,'preciototal' , 'preciounitario' , 
										'presentacion','unidadmedida');
    }
}