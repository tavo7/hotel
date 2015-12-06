@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<br>
		<br>
	</div>
</div>


<table class="table bordered span12 offset1">
	<thead>
		<tr>
			<th class="span1">COD</th>
			<th class="span1">NÚMERO</th>
			<th class="span1">PISO</th>
			<th class="span2">TIPO</th>
			<th class="span1">ESTADO</th>
			<th class="span3">USUARIO</th>
			<th class="span2">Hora Inicio</th>
			<th class="span2"></th>
		</tr>
	</thead>
	<tbody>
	@foreach ($habitaciones as $habitacion)
	<tr>
		<td>{{$habitacion->id}}</td>
		<td>{{$habitacion->nombre}}</td>
		<td>{{$habitacion->piso->nombre}}</td>
		<td>{{$habitacion->tipo->nombre}}</td>
		<td>{{$habitacion->estado}}</td>
		<td>
			@if ($habitacion->estado == 'Limpieza')
			@foreach ($habitacion->mantenimiento as $item)
				{{$item->persona->nombre}}
			@endforeach
			@endif
		</td>
		<td>
			@if ($habitacion->estado == 'Limpieza')
			@foreach ($habitacion->mantenimiento as $item)
				{{$item->pivot->horainicio}}
			@endforeach
			@endif
		</td>
		<td>
		@if ($habitacion->estado == 'Limpieza')
			<a href="/habitaciones/mantenimientoliberar/{{$habitacion->id}}">Liberar</a>
		@else
			<a href="/habitaciones/limpieza/{{$habitacion->id}}">Limpiar</a>
		@endif
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@stop