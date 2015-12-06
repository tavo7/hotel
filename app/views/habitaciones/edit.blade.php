@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span3"></div>
		<div class="span9">
			{{Form::open(array('id'=>'form_resto', 'url' => 'habitaciones/edit' , 'enctype' => 'multipart/form-data'))}}
			{{Form::hidden('habitacion_id', $habitacion->id)}}
			<fieldset>
			<legend>Crear Habitación</legend>
			{{Form::label('nombre', 'Nombre')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('nombre', $habitacion->nombre, array('placeholder'=>'HAB 301'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('descripcion', 'Descripción')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('descripcion', $habitacion->descripcion, array('placeholder'=>'Habitacion 301 simple, tercer piso'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('costodia', 'Costo Día')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('costodia', $preciodia, array('placeholder'=>'30.00'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('costohora', 'Costo Hora')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('costohora', $preciohora, array('placeholder'=>'5.00'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('costohora', 'Costo Especial')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('costoespecial', $precioespecial, array('placeholder'=>'25.00'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('piso_id', 'Selecciona Piso')}}
			<div class="input-control select" data-role="input-control">
				{{Form::select('piso_id', $pisos, $habitacion->piso_id)}}
            </div>
            {{Form::label('tipohabitacion_id', 'Selecciona Tipo de Habitación')}}
			<div class="input-control select" data-role="input-control">
				{{Form::select('tipohabitacion_id', $tiposhabitacion, $habitacion->tipohabitacion_id)}}
            </div>
            <a href="/habitaciones" class="button">Cancelar</a>
            <input type="submit" value="Guardar" class="button primary">
            </fieldset>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop