<?php

class Perfil extends \Eloquent {
	protected $table = 'perfil';
	protected $guarded = array();
	protected $fillable = array('descripcion', 
								'nombre');

	public static $rules = array();
}