<?php

class Pedido extends \Eloquent {
	protected $table = 'pedido';
	protected $fillable = [
	'habitacion_id',
	'usuario_id',
	'estado',
	'fechacancelacion',
	'fechafin',
	'fechainicio',
	'html5date'
	];

	public function productos(){
		return $this->belongsToMany('Producto', 'detallepedidoproductos', 'pedido_id', 'producto_id')
				->withPivot('cantidad', 'estado', 'precio','preciounitario','id');
	}

	public function alquiler(){
		return $this->belongsToMany('PrecioHabitacion', 'detallepedidohabitacion', 'pedido_id',
				'preciohabitacion_id')->withPivot('cantidad', 'control', 'descripcion','estado',
												'fechacontrol','precio','id');
	}

	public function persona(){
		return $this->belongsToMany('Persona', 'detallepedido', 'pedido_id', 'persona_id')
					->withPivot('fechaentrada', 'fechasalida', 'numerodehuespedes');
	}

	public function documentoventa(){
		return $this->hasMany('Documentoventa', 'pedido_id');
	}

	public function habitacion(){
		return $this->belongsTo('Habitacion', 'habitacion_id');
	}

    public function  creditos(){
        return $this->hasMany('Credito', 'pedido_id');
    }
}