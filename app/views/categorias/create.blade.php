@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span3"></div>
		<div class="span9">
			{{Form::open(array('id'=>'form_resto', 'url' => 'categorias/create' , 'enctype' => 'multipart/form-data'))}}
			<fieldset>
			<legend>Crear Categoria</legend>
			{{Form::label('nombre', 'Nombre')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('nombre', '', array('placeholder'=>'Gaseosa'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('descripcion', 'Descripción')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('descripcion', '', array('placeholder'=>'Gaseosa 500 ml.'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            <a href="/categorias" class="button">Cancelar</a>
            <input type="submit" value="Guardar" class="button primary">
            </fieldset>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop