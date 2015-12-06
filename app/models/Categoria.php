<?php

class Categoria extends \Eloquent {
	protected $table = 'categoria';
	protected $guarded = array();
	protected $fillable = array('descripcion', 'nombre');
	public static $rules = array();

	public function productos(){
		return $this->hasMany('Producto', 'categoria_id');
	}
}