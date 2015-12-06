@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span3"></div>
		<div class="span9">
			{{Form::open(array('id'=>'form_resto', 'url' => 'unidadesmedida/edit' , 'enctype' => 'multipart/form-data'))}}
			{{Form::hidden('unidad_id', $unidad->id)}}
			<fieldset>
			<legend>Crear Perfil</legend>
			{{Form::label('nombre', 'Nombre')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('nombre', $unidad->nombre, array('placeholder'=>'Ejem. Kilos'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('alias', 'Alias')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('alias', $unidad->alias, array('placeholder'=>'Ejm. KG'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            <a href="/unidadesmedida" class="button">Cancelar</a>
            <input type="submit" value="Guardar" class="button primary">
            </fieldset>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop