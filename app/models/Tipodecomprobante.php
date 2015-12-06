<?php

class Tipodecomprobante extends \Eloquent {
	protected $table = 'tipocomprobante';
	protected $guarded = array();
	protected $fillable = array('descripcion', 	'nombre');
	public static $rules = array();
}