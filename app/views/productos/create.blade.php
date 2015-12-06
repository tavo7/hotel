@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
		<div class="span3"></div>
		<div class="span9">
			@if (Request::is('productos/create2'))
			{{Form::open(array('id'=>'form_resto', 'url' => 'productos/create2' , 'enctype' => 'multipart/form-data'))}}
			<fieldset>
			<legend>Crear Producto</legend>
				{{Form::hidden('categoria_id', 1)}}
			@else
			{{Form::open(array('id'=>'form_resto', 'url' => 'productos/create' , 'enctype' => 'multipart/form-data'))}}
			<fieldset>
			<legend>Crear Producto</legend>
			{{Form::label('categoria_id', 'Categoría')}}
            <div class="input-control select" data-role="input-control">
				{{Form::select('categoria_id', $categorias, '')}}
            </div>
			@endif

			{{Form::label('nombre', 'Nombre')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('nombre', '', array('placeholder'=>'Ejem. Coca Cola 500ml'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('alias', 'Alias')}}
			<div class="input-control text" data-role="input-control">
				{{Form::text('alias', '', array('placeholder'=>'Ejem. Coca 500'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>

            {{Form::label('descripcion', 'Descripcion')}}
            <div class="input-control text" data-role="input-control">
				{{Form::text('descripcion', '', array('placeholder'=>'Ejem. Botella de medio litro'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            @if (!Request::is('productos/create2'))
				{{Form::label('precioventa', 'Precio de Venta')}}
	            <div class="input-control text" data-role="input-control">
					{{Form::text('precioventa', '', array('placeholder'=>'1.00'))}}
	                <button class="btn-clear" tabindex="-1" type="button"></button>
	            </div>
			@endif
            
            {{Form::label('stockactual', 'Stock Actual')}}
            <div class="input-control text" data-role="input-control">
				{{Form::text('stockactual', '', array('placeholder'=>'2.00'))}}
                <button class="btn-clear" tabindex="-1" type="button"></button>
            </div>
            {{Form::label('unidadmedida_id', 'Unidad de Medida')}}
            <div class="input-control select" data-role="input-control">
				{{Form::select('unidadmedida_id', $unidades, '')}}
            </div>
            @if (Request::is('productos/create2'))
            <a href="/productos/productosinterno" class="button">Cancelar</a>
            @else
            <a href="/productos" class="button">Cancelar</a>
            @endif
            <input type="submit" value="Guardar" class="button primary">
            </fieldset>
			{{Form::close()}}
		</div>
	</div>
</div>
@stop