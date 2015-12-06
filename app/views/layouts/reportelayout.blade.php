<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>
	@section('titulo')
		Sistema Hotel
	@show
	</title>
	<style type="text/css">
	body{
		font-size: 14px;
		color:  black;
		font-family: sans-serif;
	}
	.span6{
		width: 650px;
	}
	table{
		width: 100%;
	}
	td, th{
		border: 1px solid black;
	}
	.text-right{
		text-align: right;
	}
	.span1{
		width: 10%;
	}
	.span2{
		width: 20%;
	}
	.text-left{
		text-align: left;
	}
	</style>
</head>
<body class="metro">
@yield('content')
</body>
</html>