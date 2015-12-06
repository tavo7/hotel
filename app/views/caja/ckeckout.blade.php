@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span2">
		</div>
		<div class="span12">
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
			<div class="row">
			    <div class="span7">
			        <h3>{{$habitacion->nombre}} - {{$habitacion->tipo->nombre}}</h3>
			        <h4>Persona: {{$alquiler->nombre}}</h4>
			        <h4>CheckIN: {{$pedido->fechainicio}}</h4>
			        <h4>CheckOut: {{$pedido->fechafin}}</h4>
			        <br/>
			        <a href="/caja">Regresar</a>
			    </div>
			</div>
		</div>
	</div>
</div>
@stop