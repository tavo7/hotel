@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span2">
			<a href="/pisos/create" class="button primary">Crear Piso</a>
		</div>
	</div>
</div>

<table class="table bordered">
	<thead>
		<tr>
			<th class="span1">COD</th>
			<th class="span3">NOMBRE</th>
			<th class="span4">DESCRIPCION</th>
			<th class="span2">ALIAS</th>
			<th class="span3"></th>
		</tr>
	</thead>
	<tbody>
	@foreach ($pisos as $piso)
	<tr>
		<td>{{$piso->id}}</td>
		<td>{{$piso->nombre}}</td>
		<td>{{$piso->descripcion}}</td>
		<td>{{$piso->alias}}</td>
		<td>
			<a href="/pisos/edit/{{$piso->id}}">Editar</a>
			 /
			<a href="#">Eliminar</a>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@stop