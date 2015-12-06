@extends('layouts.master')
@section('content')
{{Form::open(array('id'=>'form_empresa', 'url' => '' , 'enctype' => 'multipart/form-data', 'style'=>'display:none'))}}
<fieldset>
	<div class="grid fluid">
		<div class="row">
		<div class="span1">
		</div>
			<div class="span6">
				<legend>Registrar Provedor</legend>
				<div class="row">
					<div class="span11">
						{{Form::label('razonsocial', 'Razón Social')}}
						<div class="input-control text" data-role="input-control">
						{{Form::text('razonsocial', '', array('placeholder'=>'Empresa S.A.'))}}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="span9">
						{{Form::label('ruc', 'RUC')}}
						<div class="input-control text" data-role="input-control">
						{{Form::text('ruc', '', array('placeholder'=>'3050372890'))}}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="span11">
						{{Form::label('direccion', 'Direccion')}}
						<div class="input-control text" data-role="input-control">
						{{Form::text('direccion', '', array('placeholder'=>'Av. Balta 1234'))}}
						</div>
					</div>
				</div>
				<a href="#" class="button" id="btn_cancelarregistro">Cancelar</a>
            	<input type="submit" value="Guardar" class="button primary">
			</div>
		</div>
	</div>
</fieldset>
{{Form::close()}}
{{Form::open(array('url' => '' , 'enctype' => 'multipart/form-data'))}}
<fieldset>
	<div class="grid fluid">
		<div class="row">
		<div class="span1">
		</div>
		<div class="span10">
			<legend>Ingresar Compra</legend>
			<div class="row">
				<div class="span3">
					{{Form::label('tipocomprobante_id', 'Tipo de Comprobante')}}
					<div class="input-control select" data-role="input-control">
					{{Form::select('tipocomprobante_id', $tiposdecomprobante, '')}}
					</div>
				</div>
				<div class="span2">
					{{Form::label('serie', 'Serie')}}
					<div class="input-control text" data-role="input-control">
					{{Form::text('serie', '', array('placeholder'=>'E0001', 'class'=>'text-right'))}}
					</div>
				</div>
				<div class="span2">
					{{Form::label('numero', 'Número')}}
					<div class="input-control text" data-role="input-control">
					{{Form::text('numero', '', array('placeholder'=>'0001', 'class'=>'text-right'))}}
					</div>
				</div>
				<div class="span2"></div>
				<div class="span3">
					{{Form::label('total', 'Importe Total')}}
					<div class="input-control text" data-role="input-control">
					{{Form::text('total', '', array('placeholder'=>'0.00', 'class'=>'text-right'))}}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span6">
					{{Form::label('provedor', 'Proveedor')}}
					{{Form::hidden('provedor_id', '')}}
					<div class="input-control text" data-role="input-control">
					{{Form::text('provedor', '', array('placeholder'=>'Ingrese RUC/NOMBRE'))}}
					</div>
				</div>
				<div class="span1 text-center">
					<a href="javascript:void(0)" class="button info" id="crear_empresa">Registrar</a>
				</div>
				<div class="span1"></div>
				<div class="span2">
					{{Form::label('subtotal', 'Sub Total')}}
					<div class="input-control text" data-role="input-control">
					{{Form::text('subtotal', '', array('placeholder'=>'0.00', 'class'=>'text-right'))}}
					</div>
				</div>
				<div class="span2">
					{{Form::label('igv', 'IGV')}}
					<div class="input-control text" data-role="input-control">
					{{Form::text('igv', '', array('placeholder'=>'0.00', 'class'=>'text-right'))}}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span10"></div>
				<div class="span2 text-center">
				<a href="#" id="agregaritem" class="button info">
				<i class=" icon-plus-2"></i>
				 Agregar Producto
				 </a>
				</div>
			</div>
			<div class="row">
				<div class="span11">
					<table class="table bordered">
						<thead>
							<tr>
								<th class="span3">Producto</th>
								<th class="span1">Presentación</th>
								<th class="span1">Cantidad</th>
								<th class="span1">Total Cantidad</th>
								<th class="span1">Costo Unitario</th>
								<th class="span1">Costo Total</th>
								<th class="span1"></th>
							</tr>
						</thead>
						<tbody class="productos-lista">
						<script type="text/template" id="detallecompraedit-template">
							<td>
								<div class="input-control text" data-role="input-control">
								<input placeholder="Producto" class="producto" name="producto" type="text" value="<%=productonombre%>">
								</div>
							</td>
							<td>
								<div class="input-control text" data-role="input-control">
								<input placeholder="2" class="presentacion text-right" name="presentacion" type="text" value="<%=presentacion%>">
								</div>
							</td>
							<td>
								<div class="input-control text" data-role="input-control">
								<input placeholder="2" class="cantidad text-right" name="cantidad" type="text" value="<%=cantidad%>">
								</div>
							</td>
							<td>
								<div class="input-control text" data-role="input-control">
								<input placeholder="2" class="cantidad text-right" name="cantidad" type="text" value="<%=cantidadtotal%>" disabled="">
								</div>
							</td>
							<td>
								<div class="input-control text" data-role="input-control">
								<input placeholder="1.00" class="costou text-right" name="costou" type="text" value="<%=preciounitario%>">
								</div>
							</td>
							<td>
								<div class="input-control text" data-role="input-control">
								<input placeholder="1.00" class="costou text-right" name="costou" type="text" value="<%=preciototal%>" disabled="">
								</div>
							</td>
							<td class="text-center">
								<a href="#" class="button danger">
									<i class="icon-cancel-2"></i>
								</a>
							</td>
						</script>
					</tbody>
					</table>
					
				</div>
			</div>
			<a href="/compras" class="button">Cancelar</a>
			<a href="#" class="button primary" id="btn_guardarcompras">Guardar</a>
		</div>
		</div>
	</div>
</fieldset>
{{Form::close()}}
@stop