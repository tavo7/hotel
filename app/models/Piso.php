<?php

class Piso extends \Eloquent {
	protected $table = 'piso';
	protected $guarded = array();
	protected $fillable = array('hotel_id', 'alias', 'descripcion', 'nombre');
	public static $rules = array();
}