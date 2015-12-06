@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span3">
		</div>
		<div class="span7">
		<h4>Total Ingresos: S/. {{$total}}</h4>
		<table class="table bordered">
			<thead>
				<tr>
					<th>COD</th>
					<th>Descripción</th>
					<th class="span2">Importe</th>
				</tr>
			</thead>
			<tbody>
			 @foreach ($items as $item)
				<tr>
					<td>{{$item->id}}</td>
					<td>{{$item->descripcion}}</td>
					<td class="text-right">{{$item->importetotal}}</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		</div>
	</div>
</div>
@stop