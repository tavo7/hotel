@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
	    <div class="span2"></div>
		<div class="span3">
		    <div class="input-control text" id="datepicker">
                <input type="text" id="fecha_base">
                <button class="btn-date"></button>
            </div>
        </div>
        <div class="span2">
            <a href="#" class="btn_reportes button primary">IR A REPORTES</a>
        </div>
	</div>
</div>
@stop