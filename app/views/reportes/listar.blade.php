@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
	    <div class="span2"></div>
		<div class="span6">
		    <ol>
		        <li>
		            <a href="/reportes/ventas?fecha={{$fecha}}">Ventas</a>
		        </li>
		        <li>
                    <a href="/reportes/limpieza?fecha={{$fecha}}">Limpieza</a>
                </li>
		    </ol>
        </div>
	</div>
</div>
@stop