<?php

class Unidadmedida extends \Eloquent {
	protected $table = 'unidadmedida';
	protected $guarded = array();
	protected $fillable = array('alias','nombre');
	public static $rules = array();
}