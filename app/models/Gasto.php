<?php

class Gasto extends \Eloquent {
	protected $table = 'detallegastos';
	protected $fillable = ['igv','importetotal', 'subtotal', 'detallecaja_id','tipogasto_id','descripcion',
							'numero', 'serie'];

	public function tipogasto()
	{
		return $this->belongsTo('TipodeGasto','tipogasto_id');
	}
}