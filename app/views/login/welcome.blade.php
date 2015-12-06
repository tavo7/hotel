@extends('layouts.master')
@section('content')
<div class="grid fluid">
	<div class="row">
		<div class="span6 offset3">
		<h1>
			Bienvenido {{Auth::user()->login}}
		</h1>
		</div>
	</div>
</div>
@stop