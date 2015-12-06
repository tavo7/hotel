@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span3">
			<a href="/tiposhabitacion/create" class="button primary">Crear Tipo de Habitación</a>
		</div>
	</div>
</div>

<table class="table bordered">
	<thead>
		<tr>
			<th class="span1">COD</th>
			<th class="span4">NOMBRE</th>
			<th class="span5">DESCRIPCION</th>
			<th class="span3"></th>
		</tr>
	</thead>
	<tbody>
	@foreach ($tiposhabitacion as $tipohabitacion)
	<tr>
		<td>{{$tipohabitacion->id}}</td>
		<td>{{$tipohabitacion->nombre}}</td>
		<td>{{$tipohabitacion->descripcion}}</td>
		<td>
			<a href="/tiposhabitacion/edit/{{$tipohabitacion->id}}">Editar</a>
			 /
			<a href="#">Eliminar</a>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@stop