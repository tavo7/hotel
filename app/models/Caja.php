<?php

class Caja extends \Eloquent {
	protected $table = 'caja';
	protected $fillable = ['estado', 'hotel_id' , 'impresora' , 'nombre' ];

	public function detallecaja(){
		return $this->hasMany('Detallecaja', 'caja_id');
	}
}