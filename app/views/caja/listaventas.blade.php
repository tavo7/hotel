@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
	    <div class="span1">
		</div>
		<div class="span11">
		<h3>INGRESOS HABITACIONES</h3>
        		<table class="table bordered">
        			<thead>
        				<tr>
        					<th class="span1">HAB</th>
        					<th class="span1">INGRESO</th>
        					<th class="span1">TOTAL</th>
        					<th>PERSONA</th>
        					<th class="span2">ENTRADA</th>
        					<th class="span2">SALIDA</th>
        				</tr>
        			</thead>
        			<tbody>
        			<?php $ingresototal= 0; $productototal = 0;?>
        			@foreach ($alquileres as $item)
        			<?php $habmonto = 0;
        					$hab = '-';
        			?>
        				@foreach ($item->alquiler as $alquiler)
        					<?php
        						$hab = $alquiler->habitacion->nombre;
        						$habmonto = $habmonto + $alquiler->pivot->precio;
        					?>
        				@endforeach
        				<tr>
        					<td>{{$hab}}</td>
        					<td class="text-right">
        					{{number_format($habmonto,2,'.',',')}}
        					</td>
        					<td class="text-right">
        					<?php $ingresototal = $ingresototal + $habmonto; ?>
        					{{number_format($ingresototal,2,'.',',')}}
        					</td>
        					<td>
        					@if(isset($item->pedido->persona->first()->nombre))
        					    {{$item->pedido->persona->first()->nombre}}
        					@endif
        					</td>
        					<td>{{$item->pedido->fechainicio}}</td>
        					<td>{{$item->pedido->fechafin}}</td>
        				</tr>
        			@endforeach
        			<tr>
        				<td colspan="2">
        				<strong> TOTAL INGRESOS</strong>
        				</td>
        				<td class="text-right">{{number_format($ingresototal,2,'.',',')}}</td>
        				<td></td>
        				<td></td>
        				<td></td>
        			</tr>
        			</tbody>
        		</table>
        		<br>
        		<h3>PRODUCTOS</h3>
                		<table class="table bordered">
                			<thead>
                				<tr>
                					<th class="span1 text-center">CANTIDAD</th>
                					<th class="span2 text-center">NOMBRE</th>
                					<th class="span2 text-center">IMPORTE</th>
                					<th class="span2 text-center">TOTAL</th>
                				</tr>
                			</thead>
                			<tbody>
                			@foreach ($alquileres as $item)
                				@foreach ($item->productos as $producto)
                					<?php
                						$productototal = $productototal + $producto->pivot->precio;
                					?>
                					<tr>
                						<td>
                							{{$producto->pivot->cantidad}}
                						</td>
                						<td>
                							{{$producto->nombre}}
                						</td>
                						<td class="text-right">
                							{{$producto->pivot->precio}}
                						</td>
                						<td class="text-right">
                							{{number_format($productototal,2,'.',',')}}
                						</td>
                					</tr>
                				@endforeach
                			@endforeach
                			<tr>
                				<td colspan="3">
                				<strong> TOTAL VENTA PRODUCTOS</strong>
                				</td>
                				<td class="text-right">{{number_format($productototal,2,'.',',')}}</td>
                			</tr>
                			</tbody>
                		</table>
		</div>
	</div>
</div>
@stop