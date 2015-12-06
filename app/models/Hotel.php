<?php

class Hotel extends \Eloquent {
	protected $table = 'hotel';
	protected $fillable = ['departamento', 'direccion', 'foto', 'nombre', 'provincia', 
					'razonsocial', 'ruc'];
	protected $guarded = array();
	public static $rules = array();
}