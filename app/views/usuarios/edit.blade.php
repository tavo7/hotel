@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span3"></div>
		<div class="span9">
			{{Form::open(array('id'=>'form_resto', 'url' => 'usuarios/create' , 'enctype' => 'multipart/form-data'))}}
			<fieldset>
			<legend>Crear Usuario</legend>
			{{Form::label('login', 'Nombre')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('login', $usuario->login, array('placeholder'=>'administrador'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('perfil_id', 'Selecciona Perfil')}}
			<div class="input-control select" data-role="input-control">
				{{Form::select('perfil_id', $perfiles, $usuario->perfil_id)}}
            </div>
            {{Form::label('persona_id', 'Selecciona Persona')}}
			<div class="input-control select" data-role="input-control">
				{{Form::select('persona_id', $personas, $usuario->persona_id)}}
            </div>
            {{Form::label('hotel_id', 'Hotel')}}
			<div class="input-control select" data-role="input-control">
				{{Form::select('hotel_id', $hoteles, $usuario->hotel_id)}}
            </div>
            <a href="/usuarios" class="button">Cancelar</a>
            <input type="submit" value="Guardar" class="button primary">
            </fieldset>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop