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
			@if(count($pedido) > 0)
				<div class="row">
					<div class="span10" id="datos" data-pedidoid = "{{$pedido->id}}" data-id="{{$habitacion->id}}">
						<h3>DATOS HABITACIÓN</h3>
					</div>
				</div>
				<div class="row">
					<div class="span10">
						Persona: {{$persona->nombre}}
					</div>
				</div>
				<div class="row">
                    <div class="span9">
                        Entrada: {{$pedido->fechainicio }}
                    </div>
                </div>
				<div class="row">
					<div class="span5">
						Monto a Cobrar: S/. {{number_format($porpagar,2, '.', ',')}}
					</div>
				</div>
				<div class="row">
					<div class="span9">
						Monto Pagado: S/. {{ number_format($pagado,2, '.', ',')}}
					</div>
				</div>
				<div class="row">
					<div class="span1">
						<a href="#" class="button primary ordenar">Ordenar</a>
					</div>
					<div class="span1">
						<a href="#" class="button primary cobrar">Cobrar</a>
					</div>
					<div class="span1">
						<a href="/caja/checkout/{{$pedido->id}}" class="button primary checkout">Checkout</a>
					</div>
				</div>
				{{Form::open(['url' => '/caja/cobrar', 'method' => 'POST', 'id'=>'form_cobrar', 'style'=>'display:none'])}}
				{{Form::hidden('pedido_id', $pedido->id)}}
				<div class="row">
					<div class="span3">
						{{Form::label('tipocomprobante_id', 'Comprobante')}}
						<div class="input-control select" data-role="input-control">
						{{Form::select('tipocomprobante_id', $tiposdecomprobante, '')}}
						</div>
					</div>
					<div class="span3">
					<br>
						<div class="input-control text" data-role="input-control">
						{{Form::text('serie','', ['class'=>'span1', 'placeholder'=>'Serie'])}}
						{{Form::text('numero','',['class'=>'span2','placeholder'=>'Numero'])}}
						</div>
					</div>
					<div class="span2">
						{{Form::label('serie', 'Monto a Cobrar')}}
						<div class="input-control text" data-role="input-control">
						{{Form::text('importe',number_format($porpagar,2, '.', ','), ['class'=>'text-right'])}}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="span2">
					{{Form::hidden('persona_id', '', ['id'=>'persona_id'])}}
						{{Form::label('dniruc', 'DNI/RUC')}}
						<div class="input-control text" data-role="input-control">
						{{Form::text('dniruc','',['class'=>'persona_dni search_persona'])}}
						</div>
					</div>
					<div class="span3">
						{{Form::label('nombre', 'Rz. Social / Nombre')}}
						<div class="input-control text" data-role="input-control">
						{{Form::text('nombre','',['class'=>'persona_nombre search_persona'])}}
						</div>
					</div>
					<div class="span">
					    {{Form::checkbox('credito',1,'')}} Credito
					</div>
				</div>
				<div class="row">
					<a href="#" class="button default cancelarcobro">Cancelar</a>
					{{Form::submit('Cobrar',['class'=>'primary'])}}
				</div>
				{{Form::close()}}
				<div class="motivo" style="display: none">
					<div class="row">
						<div class="span3">
							<label for="motivo">Ingrese Motivo</label>
							<div class="input-control text" data-role="input-control">
							<input name="dniruc" type="text" value="" id="motivo" autocomplete="off">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="span3">
							<a href="#" class="button default btn_cancelaranulacion">
								Cancelar
							</a>
							<a href="#" class="button primary btn_aceptaranulacion">
								Aceptar
							</a>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="span7">
						<table class="table bordered">
							<thead>
								<tr>
									<th class="span1">
										Cantidad
									</th>
									<th class="span2">
										Descripcion
									</th>
									<th class="span1">
										Costo Unitario
									</th>
									<th class="span2">
										Costo Total
									</th>
									<th></th>
								</tr>
							</thead>
							<tbody class="cesta">
								@foreach ($alquiler as $detalle)
									<tr>
										<td>{{$detalle->pivot->cantidad}}</td>
										<td>
                                            <div class="input-control text" data-role="input-control">
                                            {{Form::text('nombre',$detalle->pivot->descripcion, [
                                            'id'=>'descripcion_'.$detalle->pivot->id])}}
                                            </div>
										</td>
										<td class="text-right">{{
											number_format($detalle->pivot->precio/$detalle->pivot->cantidad,2,'.',',')
											}}</td>
										<td class="text-right">
                                            <div class="input-control text" data-role="input-control">
                                            {{Form::text('nombre',$detalle->pivot->precio, ['class'=>'text-right',
                                                'id'=>'precio_'.$detalle->pivot->id])}}
                                            </div>
										</td>
										<td>
										@if ($detalle->pivot->estado == 1)
											<a data-id="{{$detalle->pivot->id}}"
											data-itemid ="{{$detalle->id}}"
											href="#" class="button danger btn_deletealquiler">
												X
											</a>
											<a data-id="{{$detalle->pivot->id}}"
                                            data-itemid ="{{$detalle->id}}"
                                            href="#" class="button primary btn_editalquiler">
                                                <i class="icon-pencil"></i>
                                            </a>
										@endif
										</td>
									</tr>
								@endforeach
								@foreach ($productos as $detalle)
									<tr>
										<td>{{$detalle->pivot->cantidad}}</td>
										<td>{{$detalle->nombre}}</td>
										<td class="text-right">{{$detalle->pivot->preciounitario}}</td>
										<td class="text-right">{{$detalle->pivot->precio}}</td>
										<td>
										@if ($detalle->pivot->estado == 1)
											<a data-id="{{$detalle->pivot->id}}"
											data-itemid ="{{$detalle->id}}"
											href="#" class="button danger btn_deleteproduct">
												X
											</a>
										@endif
										</td>
									</tr>
								@endforeach
							</tbody>
								<tr>
									<td colspan="3">Total</td>
									<td class="text-right">{{number_format($porpagar + $pagado,2, '.', ',')}}</td>
									<td></td>
								</tr>
						</table>
					</div>
					<div class="span5">
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
			@else
			<div class="row">
			{{Form::open(['url' => '/caja/habitacion-order', 'method' => 'POST'])}}
				<div class="span12">
					{{Form::hidden('habitacion_id', $habitacion->id)}}
					{{Form::hidden('persona_id', '', ['id'=>'persona_id'])}}
					<div class="row">
					    <div class="span6">
					        <h3>{{$habitacion->nombre}} - {{$habitacion->tipo->nombre}}</h3>
					    </div>
					</div>
					<div class="row">
						<div class="span6">
							{{Form::label('nombre','Nombre Persona')}}
							<div class="input-control text" data-role="input-control">
							{{Form::text('nombre','', ['class'=>'search_persona persona_nombre'])}}
							</div>
						</div>
						<div class="span3">
							{{Form::label('dni','DNI')}}
							<div class="input-control text" data-role="input-control">
							{{Form::text('dni','',['class'=>'search_persona persona_dni'])}}
							</div>
						</div>
						<div class="span3">
							<table style="font-weight: bolder">
								@foreach ($precios as $precio)
								<tr>
									<td>S/.</td>
									<td class="text-right">{{$precio->precio}}</td>
									<td> - {{$precio->descripcion}}</td>
								</tr>
								@endforeach
							</table>
						</div>
					</div>
					<div class="row">
						<div class="span2">
							{{Form::label('huespedes','Nº de Huespedes')}}
							<div class="input-control text" data-role="input-control">
							{{Form::text('huespedes','')}}
							</div>
						</div>
						<div class="span3">
							{{Form::label('cantidad','Cantidad Dìas /Horas')}}
							<div class="input-control text" data-role="input-control">
							{{Form::text('cantidad','')}}
							</div>
						</div>
						<div class="span3">
							{{Form::label('control','Alquiler' )}}
							<div class="input-control select" data-role="input-control">
							{{Form::select('control', ['hora'=>'Hora(s)', 'dia'=>'Dia(s)','especial'=>'Especial'], 'hora')}}
							</div>
						</div>
					</div>
            		<input type="submit" value="Enviar" class="button primary">
				</div>
			{{Form::close()}}
			</div>
			@endif
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