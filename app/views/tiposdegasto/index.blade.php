@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span3">
			<a href="/tiposdegasto/create" class="button primary">Crear Tipo de Gasto</a>
		</div>
	</div>
</div>

<table class="table bordered">
	<thead>
		<tr>
			<th class="span1">COD</th>
			<th class="span4">NOMBRE</th>
			<th class="span3"></th>
		</tr>
	</thead>
	<tbody>
	@foreach ($tiposdegasto as $tipodegasto)
	<tr>
		<td>{{$tipodegasto->id}}</td>
		<td>{{$tipodegasto->nombre}}</td>
		<td>
			<a href="/tiposdegasto/edit/{{$tipodegasto->id}}">Editar</a>
			 /
			<a href="#">Eliminar</a>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@stop