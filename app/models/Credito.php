<?php

class Credito extends \Eloquent {
	protected $table = 'table_credito';
	protected $guarded = array();
	protected $fillable = array('pedido_id','estado','nombre','dni','empresa' ,'ruc' ,'detallecaja_id','importe');
	public static $rules = array();

    public function pedido(){
        return $this->belongsTo('Pedido','pedido_id');
    }
}