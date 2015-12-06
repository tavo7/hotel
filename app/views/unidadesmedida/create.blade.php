@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span3"></div>
		<div class="span9">
			{{Form::open(array('id'=>'form_resto', 'url' => 'unidadesmedida/create' , 'enctype' => 'multipart/form-data'))}}
			<fieldset>
			<legend>Crear Perfil</legend>
			{{Form::label('nombre', 'Nombre')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('nombre', '', array('placeholder'=>'Ejem. Kilos'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('alias', 'Alias')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('alias', '', array('placeholder'=>'Ejm. KG'))}}
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