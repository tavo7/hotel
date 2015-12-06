@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span2">
			<a href="/usuarios/create" class="button primary">Crear Usuario</a>
		</div>
	</div>
</div>

<table class="table bordered">
	<thead>
		<tr>
			<th class="span1">COD</th>
			<th class="span2">USUARIO</th>
			<th class="span2">PERFIL</th>
			<th class="span4">PERSONA</th>
			<th class="span3">Edit/Elim.</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($usuarios as $usuario)
	<tr>
		<td>{{$usuario->id}}</td>
		<td>{{$usuario->login}}</td>
		<td>{{$usuario->perfil->nombre}}</td>
		<td></td>
		<td>
			<a href="/usuarios/edit/{{$usuario->id}}">Editar</a> /
			<a href="/usuarios/destroy/{{$usuario->id}}">Eliminar</a>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@stop