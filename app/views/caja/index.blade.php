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
			<div class="row">
				<div class="span12">
					<div class="toolbar transparent tiposhabitacion">
						<button class="all-habitaciones">
							<i class="icon-tree-view on-left"></i>Todas
						</button>
						<script type="text/template" id="tipohabitacion-template">
							<i class="icon-tree-view on-left"></i><%=nombre%>
						</script>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span12 habitaciones">
					<script type="text/template" id="habitacion-template">
						<div class="tile-content icon">
						<%if(pedidos.length > 0 ){%>
						&nbsp;&nbsp;<time style="color:white; font-size: 12px" class="timeago" datetime="<%=pedidos[0]['html5date']%>-05:00"></time>
						<%}%>
						<%if (estado == 'Libre') {%>
							<i class="icon-open"></i>
						<%}else{%>
							<i class="icon-key-2"></i>
						<%}%>
					    </div>
					     <div class="tile-status">
					        <span class="name"><%=nombre%></span>
					    </div>
					</script>
				</div>
			</div>
		</div>
	</div>
</div>
@stop