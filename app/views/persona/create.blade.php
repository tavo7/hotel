@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span3"></div>
		<div class="span9">
			{{Form::open(array('id'=>'form_resto', 'url' => 'persona/create' , 'enctype' => 'multipart/form-data'))}}
			<fieldset>
			<legend>Crear Pesona</legend>
			{{Form::label('nombre', 'Nombre')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('nombre', '', array('placeholder'=>'Ingresa nombres y apellidos'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('DNI', 'DNI')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('dni', '', array('placeholder'=>'45934821'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>

            {{Form::label('direccion', 'Dirección')}}
            <div class="input-control text" data-role="input-control">
				{{Form::text('direccion', '', array('placeholder'=>'Av. Balta # 146'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('distrito', 'Distrito')}}
            <div class="input-control text" data-role="input-control">
				{{Form::text('distrito', '', array('placeholder'=>'La Victoria'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('provincia', 'Provincia')}}
            <div class="input-control text" data-role="input-control">
				{{Form::text('provincia', '', array('placeholder'=>'Chiclayo'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('departamento', 'Departamento')}}
            <div class="input-control text" data-role="input-control">
				{{Form::text('departamento', '', array('placeholder'=>'Lambayeque'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            <a href="/personas" class="button">Cancelar</a>
            <input type="submit" value="Guardar" class="button primary">
            </fieldset>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop