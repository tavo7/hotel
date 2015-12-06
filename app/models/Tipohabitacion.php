<?php

class Tipohabitacion extends \Eloquent {
	protected $table = 'tipohabitacion';
	protected $guarded = array();
	protected $fillable = array('descripcion', 	'nombre');
	public static $rules = array();
}