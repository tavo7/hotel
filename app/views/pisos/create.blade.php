@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span3"></div>
		<div class="span9">
			{{Form::open(array('id'=>'form_resto', 'url' => 'pisos/create' , 'enctype' => 'multipart/form-data'))}}
			{{Form::hidden('hotel_id', Auth::user()->hotel_id)}}
			<fieldset>
			<legend>Crear Piso</legend>
			{{Form::label('nombre', 'Nombre')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('nombre', '', array('placeholder'=>'1er Piso.'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('descripcion', 'Descripcion')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('descripcion', '', array('placeholder'=>'1er piso'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('alias', 'Alias')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('alias', '', array('placeholder'=>'1P'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            <a href="/pisos" class="button">Cancelar</a>
            <input type="submit" value="Guardar" class="button primary">
            </fieldset>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop