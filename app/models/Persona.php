<?php
class Persona extends \Eloquent {
	protected $table = 'persona';
	protected $guarded = array();
	protected $fillable = array('departamento' , 
							'direccion' , 
							'distrito' , 
							'dni' , 
							'nombre' , 
							'provincia' , 
							'razonsocial' , 
							'ruc');

	public static $rules = array();

}