@extends('layouts.master')
@section('content')
<div class="grid">
	<div class="row">
	{{Form::open(['url' => 'caja/index' , 'enctype' => 'multipart/form-data'])}}
		<div class="span2">
		</div>
		<div class="span3">
			<div class="input-control select" data-role="input-control">
			{{Form::select('caja_id', $caja, '')}}
			</div>
		</div>
		<div class="span3">
			<div class="input-control text" data-role="input-control">
			{{Form::text('montoinicial', '',['placeholder'=> '0.00', 'class'=>'text-right'])}}
			</div>
		</div>
		<div class="span3">
			{{Form::submit('Abrir', ['class'=>'button primary'])}}
		</div>
	{{Form::close()}}
	</div>
</div>
@stop