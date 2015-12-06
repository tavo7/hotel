@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span2">
			<a href="/unidadesmedida/create" class="button primary">Crear Unidad</a>
		</div>
	</div>
</div>

<table class="table bordered">
	<thead>
		<tr>
			<th class="span1">COD</th>
			<th class="span3">ALIAS</th>
			<th class="span5">NOMBRE</th>
			<th class="span3">Edit/Elim.</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($unidades as $unidad)
	<tr>
		<td>{{$unidad->id}}</td>
		<td>{{$unidad->alias}}</td>
		<td>{{$unidad->nombre}}</td>
		<td>
			<a href="/unidadesmedida/edit/{{$unidad->id}}">Editar</a> /
			<a href="#">Eliminar</a>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@stop