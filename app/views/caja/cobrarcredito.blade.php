@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span1">
		</div>
		<div class="span11">
		<table class="table bordered">
			<thead>
				<tr>
					<th class="span1">HAB</th>
					<th>NOMBRE</th>
					<th>EMPRESA</th>
					<th class="span2">RUC</th>
					<th class="span1">IMPORTE</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			 @foreach ($creditos as $item)
				<tr>
					<td>{{$item->pedido->habitacion->nombre}}</td>
					<td>{{$item->nombre}}</td>
					<td>{{$item->empresa}}</td>
					<td>{{$item->ruc}}</td>
					<td>{{$item->importe}}</td>
					<td>
					<a href="#" data-id="{{$item->id}}" class="cobrar_deuda">Cobrar</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		</div>
	</div>
</div>
@stop