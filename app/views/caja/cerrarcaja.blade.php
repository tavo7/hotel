@extends('layouts.master')
@section('content')
{{Form::open(['url' => '/caja/cerrar-caja' , 'method'=>'POST','enctype' => 'multipart/form-data'])}}
<div class="grid">
	<div class="row">
		<div class="span3">
		</div>
		<div class="span6">
			<fieldset>
				<legend>Ventas</legend>
			<div class="row">
				<div class="span2">
					{{Form::label('ventas', 'Total')}}
				</div>
				<div class="span2">
					<div class="input-control text"  data-role="input-control">
					{{Form::text('ventas', number_format($ventas,2,'.',','),
					['placeholder'=>'0.00', 'class'=>'text-right', 'disabled'=>'disabled'])}}
				</div>
				</div>
			</div>
			</fieldset>
		</div>
		<div class="span6">
			<fieldset>
				<legend>Movimientos Caja</legend>
				<div class="row">
					<div class="span2">
						{{Form::label('montoinicial', 'Monto Inicial')}}
					</div>
					<div class="span2">
						<div class="input-control text"  data-role="input-control">
						{{Form::text('montoinicial', $detallecaja->montoinicial,
						['placeholder'=>'0.00', 'class'=>'text-right', 'disabled'=>'disabled'])}}
					</div>
					</div>
				</div>
				<div class="row">
					<div class="span2">
						{{Form::label('ingresos', 'Ingresos')}}
					</div>
					<div class="span2">
						<div class="input-control text"  data-role="input-control">
						{{Form::text('ingresos', $ingresos,
						['placeholder'=>'0.00', 'class'=>'text-right', 'disabled'=>'disabled'])}}
					</div>
					</div>
				</div>
				<div class="row">
					<div class="span2">
						{{Form::label('gastos', 'Gastos')}}
					</div>
					<div class="span2">
						<div class="input-control text"  data-role="input-control">
						{{Form::text('gastos', $gastos,
						['placeholder'=>'0.00', 'class'=>'text-right', 'disabled'=>'disabled'])}}
					</div>
					</div>
				</div>
				<div class="row">
					<div class="span2">
						{{Form::label('total', 'Total')}}
					</div>
					<div class="span2">
						<div class="input-control text"  data-role="input-control">
						{{Form::text('total',
							number_format($detallecaja->montoinicial + $ingresos - $gastos,2,'.',','),
						['placeholder'=>'0.00', 'class'=>'text-right', 'disabled'=>'disabled'])}}
					</div>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	<div class="row">
		<div class="span3">
		</div>
		<div class="span6">
			<fieldset>
				<legend>Arqueo</legend>
				<div class="row">
					<div class="span2">
						{{Form::label('cantidadteorica', 'Cantidad Teoríca')}}
					</div>
					<div class="span2">
						<div class="input-control text"  data-role="input-control">
						{{Form::text('cantidadteorica',number_format($detallecaja->montoinicial + $ingresos - $gastos + $ventas,2,'.',''),
						['placeholder'=>'0.00', 'class'=>'text-right', 'disabled'=>'disabled'])}}
					</div>
					</div>
				</div>
				<div class="row">
					<div class="span2">
						{{Form::label('arqueo', 'Cantidad Real')}}
					</div>
					<div class="span2">
						<div class="input-control text"  data-role="input-control">
						{{Form::text('arqueo', '',
						['placeholder'=>'0.00', 'class'=>'text-right'])}}
					</div>
					</div>
				</div>
				<div class="row">
					<div class="span2">
						{{Form::label('diferencia', 'Descuadre')}}
					</div>
					<div class="span2">
						<div class="input-control text"  data-role="input-control">
						{{Form::text('diferencia', '',
						['placeholder'=>'0.00', 'class'=>'text-right', 'disabled'=>'disabled'])}}
					</div>
					</div>
				</div>
			</fieldset>
		</div>
	</div>
	<div class="row">
		<div class="span8">
		</div>
		<div class="span6">
			<a href="/caja" class="button default">Cancelar</a>
			{{Form::submit('Registrar',['class'=>'primary'])}}
		</div>
	</div>
</div>
{{Form::close()}}
@stop