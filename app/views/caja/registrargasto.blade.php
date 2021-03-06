@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span3">
		</div>
		<div class="span11">
			<nav class="horizontal-menu compact bg-steel">
			    <ul>
			        <li>
			            <a href="/caja/venta-directa">Venta Directa</a>
			        </li>
			        <li>
			            <a href="/caja/registrar-gasto">Registrar Gasto</a>
			        </li>
			        <li>
			            <a href="/caja/registrar-ingreso">Registrar Ingreso</a>
			        </li>
			         <li>
			            <a href="/caja/ventas">Lista de Ventas</a>
			        </li>
			         <li>
			            <a href="/caja/gastos">Lista de Gastos</a>
			        </li>
			         <li>
			            <a href="/caja/ingresos">Lista de Ingresos</a>
			        </li>
			    </ul>
			</nav>
			{{Form::open(['url'=>'/caja/registrar-gasto', 'method' => 'POST'])}}
			<div class="row">
				<div class="span4">
				{{Form::label('tipodegasto_id', 'Tipo de Gasto')}}
					<div class="input-control select" data-role="input-control">
						{{Form::select('tipodegasto_id', $tipodegastos, '')}}
					</div>
				</div>
				<div class="span1">
					{{Form::label('serie', 'Serie')}}
					<div class="input-control text"  data-role="input-control">
						{{Form::text('serie', '', ['placeholder'=>'001'])}}
					</div>
				</div>
				<div class="span2">
					{{Form::label('numero', 'Número')}}
					<div class="input-control text"  data-role="input-control">
						{{Form::text('numero', '', ['placeholder'=>'001'])}}
					</div>
				</div>
				<div class="span2">
					{{Form::label('importetotal', 'Importe')}}
					<div class="input-control text"  data-role="input-control">
						{{Form::text('importetotal', '', ['placeholder'=>'0.00', 'class'=>'text-right'])}}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span8">
					{{Form::label('descripcion', 'Descripción')}}
					<div class="input-control text"  data-role="input-control">
						{{Form::text('descripcion', '', ['placeholder'=>'Descripción, justificación'])}}
					</div>
				</div>
			</div>
			<div class="row">
				<a href="/caja" class="button default">Cancelar</a>
				{{Form::submit('Registrar',['class'=>'primary'])}}
			</div>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop