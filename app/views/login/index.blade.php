@extends('layouts.master')
@section('content')
<div class="grid fluid">
	<div class="row">
		<div class="span4 offset3">
			{{Form::open(array('id'=>'form_resto', 'url' => 'login' , 'enctype' => 'multipart/form-data'))}}
			<fieldset>
				<legend>Iniciar Sesión</legend>
				{{Form::label('login', 'Usuario')}}
				<div class="input-control text" data-role="input-control">
					{{Form::text('login', '', array('placeholder'=>'Ingresa Usuario'))}}
	                <button class="btn-clear" tabindex="-1" type="button"></button>
	            </div>
	            {{Form::label('password', 'Contraseña')}}
				<div class="input-control text" data-role="input-control">
					{{Form::password('password', array('placeholder'=>'******'))}}
	                <button class="btn-clear" tabindex="-1" type="button"></button>
	            </div>
	            <input type="submit" value="Entrar" class="button primary">
			</fieldset>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop