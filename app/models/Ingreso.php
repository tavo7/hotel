<?php

class Ingreso extends \Eloquent {
	protected $table = 'detalleingresos';
	protected $fillable = ['importetotal','descripcion', 'detallecaja_id'];
}