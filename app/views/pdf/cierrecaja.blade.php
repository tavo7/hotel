@extends('layouts.reportelayout')
@section('content')
<div class="grid fluid">
	<div class="row">
		<div class="span6 offset1">
		<h3>ENCARGADO</h3>
		<table>
			<thead>
				<tr>
					<th class="text-left span2">Nombre</th>
					<th class="text-left">{{$encargado->nombre}}</th>
				</tr>
				<tr>
					<th class="text-left span2">Turno</th>
					<th class="text-left">{{$detallecaja->created_at}} - {{$fechacierre}}</th>
				</tr>
			</thead>
		</table>
		<br>
		<h3>INGRESOS HABITACIONES</h3>
		<table class="table bordered">
			<thead>
				<tr>
					<th class="span1">HAB</th>
					<th class="span2">INGRESO</th>
					<th class="span2">TOTAL</th>
					<th>OBSERVACIONES</th>
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
					<td></td>
				</tr>
			@endforeach
			<tr>
				<td colspan="2">
				<strong> TOTAL INGRESOS</strong>
				</td>
				<td class="text-right">{{number_format($ingresototal,2,'.',',')}}</td>
				<td></td>
			</tr>
			</tbody>
		</table>
		<br>
		<h3>GASTOS</h3>
		<table class="table bordered">
			<thead>
				<tr>
					<th class="span2">TIPO DE GASTO</th>
					<th class="span2">EGRESO</th>
					<th class="span2">TOTAL</th>
					<th>DESCRIPCION</th>
				</tr>
			</thead>
			<tbody>
			<?php $gastostotal= 0; ?>
			@foreach ($gastos as $item)
				<tr>
					<td>{{$item->tipogasto->nombre}}</td>
					<td class="text-right">
					{{$item->importetotal}}
					</td>
					<td class="text-right">
					<?php $gastostotal = $gastostotal + $item->importetotal; ?>
					{{number_format($gastostotal,2,'.',',')}}
					</td>
					<td>
						{{$item->descripcion}}
					</td>
				</tr>
			@endforeach
			<tr>
				<td colspan="2">
				<strong>TOTAL GASTOS</strong>
				</td>
				<td class="text-right">{{number_format($gastostotal,2,'.',',')}}</td>
				<td></td>
			</tr>
			</tbody>
		</table>
		<br>
		<h3>RESUMEN</h3>
		<table>
			<thead>
				<tr>
					<th class="text-left">MONTO INICIAL	</th>
					<th class="span2 text-right">{{number_format($montoinicial,2,'.',',')}}</th>
				</tr>
				<tr>
					<th class="text-left">TOTAL INGRESOS HABITACION	</th>
					<th class="span2 text-right">{{number_format($ingresototal,2,'.',',')}}</th>
				</tr>
				<tr>
					<th class="text-left">TOTAL INGRESOS A CAJA</th>
					<th class="span2 text-right">
						{{number_format($ingresoscaja,2,'.',',')}}
					</th>
				</tr>
				<tr>
					<th class="text-left">TOTAL GASTOS</th>
					<th class="span2 text-right">{{number_format($gastostotal,2,'.',',')}}</th>
				</tr>

				<tr>
					<th class="text-left">IMPORTE TOTAL</th>
					<th class="span2 text-right">
						<?php $importetotal =$montoinicial + $ingresototal +  $ingresoscaja - $gastostotal;?>
						{{number_format($importetotal,2,'.',',')}}
					</th>
				</tr>
				<tr>
                    <th class="text-left">DESCUADRE</th>
                    <th class="span2 text-right">
                        {{number_format($diferencia,2,'.',',')}}
                    </th>
                </tr>
			</thead>
		</table>
		<br>
		<h3>PRODUCTOS</h3>
		<table>
			<thead>
				<tr>
					<th class="span1">CANTIDAD</th>
					<th class="span2">NOMBRE</th>
					<th class="span2 text-right">IMPORTE</th>
					<th class="span2 text-right">TOTAL</th>
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
						<td>
							{{$producto->pivot->precio}}
						</td>
						<td>
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
		<br>
		<h3>
		REPORTE DE PAGOS PENDIENTES
		</h3>
		<table>
		    <thead>
		        <tr>
                    <th class="span1">HAB</th>
                    <th class="span2">PERSONA</th>
                    <th class="span2">DNI</th>
                    <th class="span2">EMPRESA</th>
                    <th class="span2">MONTO</th>
                </tr>
		    </thead>
		    <tbody>
		    @foreach($creditos as $credito)
		        <tr>
		            <td>{{$credito->pedido->habitacion->nombre}}</td>
		            <td>{{$credito->nombre}}</td>
		            <td>{{$credito->dni}}</td>
		            <td>{{$credito->empresa}}</td>
		            <td>{{$credito->importe}}</td>
		        </tr>
		    @endforeach
		    </tbody>
		</table>
		<h3>REPORTE DE LIMPIEZA</h3>
		<table class="table bordered">
			<thead>
				<tr>
					<th class="span1">HAB</th>
					<th class="span3">RESPONSABLE</th>
					<th class="span2">HORA INICIO</th>
					<th class="span2">HORA FIN</th>
				</tr>
			</thead>
			<tbody>
			@foreach ($habitaciones as $habitacion)
				@foreach ($habitacion->mantenimiento as $item)
				<tr>
					<td>{{$habitacion->nombre}}</td>
					<td>{{$item->persona->nombre}}</td>
					<td>{{$item->pivot->horainicio}}</td>
					<td>{{$item->pivot->horatermino}}</td>
				</tr>
				@endforeach
			@endforeach
			</tbody>
		</table>
		</div>
	</div>
</div>
@stop