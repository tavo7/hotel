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
				<div class="span1">
					<a href="#" class="button primary btn_ventadirecta">Cobrar</a>
				</div>
			</div>

				<div class="row">
					<div class="span6">
						<table class="table bordered">
							<thead>
								<tr>
									<th class="span1">
										Cantidad
									</th>
									<th class="span3">
										Descripcion
									</th>
									<th class="span2">
										Costo Unitario
									</th>
									<th class="span2">
										Costo Total
									</th>
									<th>

									</th>
								</tr>
							</thead>
							<tbody class="cesta">
							</tbody>
								<tr>
									<td colspan="4">Total</td>
									<td class="text-right">
										<span class="sumaprecios"></span>
									</td>
								</tr>
						</table>
					</div>
					<div class="span6">
						<div class="accordion" data-role="accordion">
						@foreach ($categorias as $categoria)
						    <div class="accordion-frame">
						        <a href="javascript:void(0)" class="heading">{{$categoria->nombre}}</a>
						        <div class="content">
						        	<div class="row">
						        		<div class="span6">
						        		@foreach ($categoria->productos as $producto)
						        			<div class="tile bg-cyan" data-id="{{$producto->id}}">
						        				<div class="tile-content icon">
											        <i class="icon-cart-2"></i>
											    </div>
											    <div class="tile-status">
											        <span class="name">{{$producto->alias}}</span>
											    </div>
											    <div class="brand">
											        <div class="badge bg-red">{{$producto->precioventa}}</div>
											    </div>
											</div>
										@endforeach
						        		</div>
						        	</div>
						        </div>
						    </div>
						@endforeach
						</div>
					</div>
				</div>
		</div>
	</div>
</div>
<script type="text/template" id="productocesta-template">
		<td>
			<div class="input-control text" data-role="input-control">
				<input class="cantidad text-right" name="cantidad" type="text" value="<%=cantidad%>">
			</div>
		</td>
		<td>
			<%=nombre%>
		</td>
		<td class="text-right">
			<%=preciounitario%>
		</td>
		<td class="text-right">
			<div class="input-control text" data-role="input-control">
				<input class="preciototal text-right" name="cantidad" type="text" value="<%=precio%>">
			</div>
		</td>
		<td>
		<a href="#" class="button danger">X</a>
		</td>
</script>
@stop