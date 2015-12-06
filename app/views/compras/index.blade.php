@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span2">
			<a href="/compras/create" class="button primary">Registrar</a>
		</div>
	</div>
</div>

<table class="table bordered">
	<thead>
		<tr>
			<th class="span1">COD</th>
			<th class="span3">FECHA</th>
			<th class="span2">TIPOCOMPROBANTE</th>
			<th class="span2">TOTAL</th>
			<th class="span4">PROVEEDOR</th>
			<th class="span3">Edit/Elim.</th>
		</tr>
	</thead>
	<tbody>
	@foreach ($compras as $compra)
	<tr>
		<td>
			<a href="/compras/detalle/{{$compra->id}}">
				{{$compra->id}}
			</a>
		</td>
		<td>{{$compra->fecha}}</td>
		<td>{{$compra->tipocomprobante->nombre}}</td>
		<td class="text-right">{{$compra->total}}</td>
		<td>
		@if(isset($compra->provedor->razonsocial))
		{{$compra->provedor->razonsocial}}
		@endif
		</td>
		<td>
			<a href="/compras/edit/{{$compra->id}}">Editar</a>
		</td>
	</tr>
	@endforeach
	</tbody>
</table>
@stop