@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span2">
		@if (Request::is('productos/productosinterno'))
			<a href="/productos/create2" class="button primary">Crear Producto</a>
		@else
			<a href="/productos/create" class="button primary">Crear Producto</a>
		@endif
		</div>
	</div>
</div>

<table class="table bordered">
	<thead>
		<tr>
			<th class="span1">COD</th>
			<th class="span2">STOCK</th>
			<th class="span3">NOMBRE</th>
			<th class="span2">UNIDAD MEDIDA</th>
			<th class="span3">CATEGORÍA</th>
			<th class="span2">PRECIO VENTA</th>
			<th class="span2">PRECIO COMPRA</th>
			<th class="span2">TOTAL</th>
			<th class="span3">Edit/Elim.</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($productos as $producto)
	<tr>
		<td>{{$producto->id}}</td>
		<td>{{$producto->stockactual}}</td>
		<td>{{$producto->nombre}}</td>
		<td>{{$producto->unidadmedida->nombre}}</td>
		<td>{{$producto->categoria->nombre}}</td>
		<td>{{$producto->precioventa}}</td>
		<td>{{$producto->costo}}</td>
		<td>{{number_format($producto->precioventa*$producto->stockactual, 2, '.',',')
			}}</td>
		<td>
			@if (Request::is('productos/productosinterno'))
				<a href="/productos/edit2/{{$producto->id}}">Editar</a>
			@else
				<a href="/productos/edit/{{$producto->id}}">Editar</a>
			@endif
			 /
			<a href="/productos/destroy/{{$producto->id}}">Eliminar</a>
		</td>
	</tr>
	@endforeach
	<tr>
		<td colspan="7"></td>
		<td>{{number_format($total,2,'.',',')}}</td>
		<td></td>
	</tr>
	</tbody>
</table>
@stop