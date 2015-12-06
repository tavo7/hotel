@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span2">
			<a href="/habitaciones/create" class="button primary">Crear Habitación</a>
		</div>
	</div>
</div>


<table class="table bordered span12 offset1">
	<thead>
		<tr>
			<th class="span1">COD</th>
			<th class="span2">NÚMERO</th>
			<th class="span2">PISO</th>
			<th class="span2">TIPO</th>
			<th class="span1">COSTO DÍA</th>
			<th class="span1">COSTO HORA</th>
			<th class="span1">COSTO ESPECIAL</th>
			<th class="span3"></th>
		</tr>
	</thead>
	<tbody>
	@foreach ($habitaciones as $habitacion)
	<tr>
		<td>{{$habitacion->id}}</td>
		<td>{{$habitacion->nombre}}</td>
		<td>{{$habitacion->piso->nombre}}</td>
		<td>{{$habitacion->tipo->nombre}}</td>
		@foreach ($habitacion->precios as $precio)
			<td class="text-right">{{$precio->precio}}</td>
		@endforeach
		<td>
			<a href="/habitaciones/edit/{{$habitacion->id}}">Editar</a>
			 /
			<a href="#">Eliminar</a>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@stop