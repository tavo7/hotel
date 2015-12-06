@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span2">
			<a href="/perfiles/create" class="button primary">Crear Perfil</a>
		</div>
	</div>
</div>

<table class="table bordered">
	<thead>
		<tr>
			<th class="span1">COD</th>
			<th class="span3">NOMBRE</th>
			<th class="span5">DESCRIPCION</th>
			<th class="span3">Edit/Elim.</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($perfiles as $perfil)
	<tr>
		<td>{{$perfil->id}}</td>
		<td>{{$perfil->nombre}}</td>
		<td>{{$perfil->descripcion}}</td>
		<td>
			<a href="/perfiles/edit/{{$perfil->id}}">Editar</a> /
			<a href="/perfiles/destroy/{{$perfil->id}}">Eliminar</a>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@stop