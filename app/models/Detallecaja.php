<?php

class Detallecaja extends \Eloquent {
	protected $table = 'detallecaja';
	protected $fillable = ['arqueo', 'diferencia', 'gastos','ingresos', 'montoinicial', 'ventas',
	'caja_id' , 'usuario_id' ,'fechacierre', 'fechainicio', ];

	public function caja()
	{
		return $this->belongsTo('Caja', 'caja_id');
	}

	public function gastos()
	{
		return $this->hasMany('Gasto', 'detallecaja_id');
	}

	public function ingresos()
	{
		return $this->hasMany('Ingreso', 'detallecaja_id');
	}

	public function ventas()
	{
		return $this->hasMany('Documentoventa', 'detallecaja_id');
	}

    public function creditos(){
        return $this->hasMany('Credito', 'detallecaja_id');
    }

    public function usuario(){
        return $this->belongsTo('Usuario', 'usuario_id');
    }
}