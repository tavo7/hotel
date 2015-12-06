<?php
/**
 * Created by PhpStorm.
 * User: icalvay
 * Date: 28/11/14
 * Time: 06:06 PM
 */

class Alquiler extends  \Eloquent {
    protected $table = 'detallepedidohabitacion';
    protected $fillable = [
        'estado' ,
        'precio' ,
        'control',
        'cantidad',
        'pedido_id',
        'preciohabitacion_id',
        'descripcion' ,
        'fechacontrol',
        'motivo'
    ];
} 