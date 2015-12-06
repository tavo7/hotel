@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span3"></div>
		<div class="span9">
			{{Form::open(array('id'=>'form_resto', 'url' => 'tiposhabitacion/edit' , 'enctype' => 'multipart/form-data'))}}
			{{Form::hidden('tipohabitacion_id', $tipohabitacion->id)}}
			<fieldset>
			<legend>Crear Tipo de Habitación</legend>
			{{Form::label('nombre', 'Nombre')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('nombre', $tipohabitacion->nombre, array('placeholder'=>'Simple'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('descripcion', 'Descripcion')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('descripcion', $tipohabitacion->descripcion, array('placeholder'=>'Habitación Simple'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            <a href="/tiposhabitacion" class="button">Cancelar</a>
            <input type="submit" value="Guardar" class="button primary">
            </fieldset>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop