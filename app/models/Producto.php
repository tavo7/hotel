<?php

class Producto extends \Eloquent {
	protected $table = 'producto';
	protected $guarded = array();
	protected $fillable = array('estado', 'costo', 'precioventa', 'stockactual', 'stockmaximo', 'stockminimo', 
							'categoria_id', 'unidadmedida_id', 'alias', 'descripcion', 'nombre');
	public static $rules = array();

	public function categoria(){
		return $this->belongsTo('Categoria', 'categoria_id');
	}

	public function unidadmedida(){
		return $this->belongsTo('Unidadmedida', 'unidadmedida_id');
	}
}