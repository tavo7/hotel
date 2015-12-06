<?php

class Habitacion extends \Eloquent {
	protected $table = 'habitacion';
	protected $guarded = [];
	protected $fillable = ['piso_id' , 'tipohabitacion_id' , 'descripcion', 'estado', 'nombre'];
	public static $rules = [];

	public function precios(){
		return $this->hasMany('PrecioHabitacion', 'habitacion_id');
	}

	public function piso(){
		return $this->belongsTo('Piso', 'piso_id');
	}

	public function tipo(){
		return $this->belongsTo('Tipohabitacion', 'tipohabitacion_id');
	}

	public function pedidos(){
		return $this->hasMany('Pedido', 'habitacion_id');
	}

	public function mantenimiento(){
		return $this->belongsToMany('Usuario','detallemantenimiento', 'habitacion_id','usuario_id')
				->withPivot('horainicio','horatermino',	'estado');
	}
}