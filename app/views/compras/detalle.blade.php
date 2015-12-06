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
					{{Form::label('tipocomprobante_id', 'Tipo de Comprobante:')}}
					<div class="input-control select" data-role="input-control">
						&nbsp;{{$compra->tipocomprobante->nombre}}
					</div>
				</div>
				<div class="span2">
					{{Form::label('serie', 'Serie:')}}
					<div class="input-control text" data-role="input-control">
						&nbsp;{{$compra->serie}}
					</div>
				</div>
				<div class="span2">
					{{Form::label('numero', 'Número:')}}
					<div class="input-control text" data-role="input-control">
					 &nbsp;{{$compra->numero}}
					</div>
				</div>
				<div class="span2"></div>
				<div class="span3">
					{{Form::label('total', 'Importe Total:')}}
					<div class="input-control text text-right" data-role="input-control">
					{{$compra->total}}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="span6">
					{{Form::label('provedor', 'Proveedor:')}}
					<div class="input-control text" data-role="input-control">
						&nbsp;{{$compra->provedor->razonsocial}}
					</div>
				</div>
				<div class="span1 text-center">
				</div>
				<div class="span1"></div>
				<div class="span2">
					{{Form::label('subtotal', 'Sub Total')}}
					<div class="input-control text text-right" data-role="input-control">
					{{$compra->subtotal}}
					</div>
				</div>
				<div class="span2">
					{{Form::label('igv', 'IGV')}}
					<div class="input-control text text-right" data-role="input-control">
					{{$compra->igv}}
					</div>
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
						@foreach ($productos as $producto)
							<tr>
								<td>
									{{$producto->nombre}}
								</td>
								<td class="text-right">
									{{$producto->pivot->presentacion}}
								</td>
								<td class="text-right">
									{{$producto->pivot->cantidad}}
								</td>
								<td class="text-right">
									{{$producto->pivot->cantidadtotal}}
								</td>
								<td class="text-right">
									{{$producto->pivot->preciounitario}}
								</td>
								<td class="text-right">
									{{$producto->pivot->preciototal}}
								</td>
								<td class="text-right">
								</td>
							</tr>
						@endforeach
					</tbody>
					</table>
				</div>
			</div>
		</div>
		</div>
	</div>
</fieldset>
{{Form::close()}}
@stop