@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span2">
			<a href="/categorias/create" class="button primary">Crear Categoría</a>
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
	@foreach ($categorias as $categoria)
	<tr>
		<td>{{$categoria->id}}</td>
		<td>{{$categoria->nombre}}</td>
		<td>{{$categoria->descripcion}}</td>
		<td>
			<a href="/categorias/edit/{{$categoria->id}}">Editar</a> /
			<a href="#">Eliminar</a>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@stop