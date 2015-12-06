@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span2">
			<a href="/persona/create" class="button primary">Crear Persona</a>
		</div>
	</div>
</div>

<table class="table bordered">
	<thead>
		<tr>
			<th class="span1">COD</th>
			<th class="span4">NOMBRE</th>
			<th class="span2">DNI</th>
			<th class="span2">USUARIO</th>
			<th class="span3">Edit/Elim.</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($personas as $persona)
	<tr>
		<td>{{$persona->id}}</td>
		<td>{{$persona->nombre}}</td>
		<td>{{$persona->dni}}</td>
		<td></td>
		<td>
			<a href="/persona/edit/{{$persona->id}}">Editar</a> /
			<a href="/persona/destroy/{{$persona->id}}">Eliminar</a>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@stop