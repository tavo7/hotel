<?php

class PrecioHabitacion extends \Eloquent {
	protected $table = 'preciohabitacion';
	protected $fillable = ['habitacion_id', 'descripcion', 'precio'];

	public function habitacion()
	{
		return $this->belongsTo('Habitacion','habitacion_id');
	}
}