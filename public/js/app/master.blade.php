<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>
	@section('titulo')
		Sistema Hotel
	@show
	</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css">
	<!-- bower:css -->
	<link rel="stylesheet" href="/vendor/metro-ui-css/css/metro-bootstrap.css" />
	<link rel="stylesheet" href="/vendor/metro-ui-css/css/metro-bootstrap-responsive.css" />
	<!-- endbower -->
	<!-- inject:css -->
	<link rel="stylesheet" href="/css/main.css">
	<!-- endinject -->
</head>
<body class="metro">
<nav class="navigation-bar">
    <div class="navigation-bar-content">
        <a href="/" class="element"><span class="icon-grid-view"></span> HOTEL ALFONSO UGARTE<sup>1.0</sup></a>
        <span class="element-divider"></span>
        <a class="pull-menu" href="#"></a>
        <!-- if (Auth::check()) -->
        <ul class="element-menu" style="display: block;">
            <li>
                <a class="dropdown-toggle" href="#">Maestros</a>
                <ul class="dropdown-menu " data-role="dropdown">
                    <li><a href="/personas">Personas</a></li>
                    <li><a href="/perfiles">Perfiles</a></li>
                    <li><a href="/usuarios">Usuarios</a></li>
                     <li><a href="/unidadesmedida">Unidades de Medida</a></li>
                    <li><a href="/categorias">Categorias</a></li>
                    <li><a href="/productos">Productos Venta</a></li>
                    <li><a href="/productos/productosinterno">Productos</a></li>
                    <li><a href="pisos">Pisos</a></li>
                    <li><a href="tiposhabitacion">Tipos de Habitación</a></li>
                    <li><a href="habitaciones">Habitación</a></li>
                </ul>
            </li>
            <li>
            	<a class="dropdown-toggle" href="#">Compras</a>
                <ul class="dropdown-menu " data-role="dropdown">
                	<li><a href="/compras">Listar</a></li>
                    <li><a href="/compras/create">Registrar</a></li>
                </ul>
            </li>
            <li>
                <a class="dropdown-toggle" href="#">Ventas</a>
                <ul class="dropdown-menu " data-role="dropdown">
                    <li><a href="/caja">Caja</a></li>
                    <li><a href="/caja/cerrarcaja">Cierre Caja</a></li>
                </ul>
            </li>
        </ul>
        <!-- endif -->
    </div>
</nav>
@yield('content')
	<!-- bower:js -->
	<script src="/vendor/jquery/dist/jquery.js"></script>
	<script src="/vendor/jquery-ui/jquery-ui.js"></script>
	<script src="/vendor/metro-ui-css/min/metro.min.js"></script>
	<script src="/vendor/underscore/underscore.js"></script>
	<script src="/vendor/backbone/backbone.js"></script>
	<script src="/vendor/backbone.localStorage/backbone.localStorage.js"></script>
	<!-- endbower -->
    <script src="/js/init.js"></script>
	<!-- inject:js -->
    <script src="/js/app/collections/detallecompra.js"></script>
    <script src="/js/app/collections/habitaciones.js"></script>
    <script src="/js/app/collections/pisos.js"></script>
    <script src="/js/app/collections/tiposhabitacion.js"></script>
    <script src="/js/app/models/detallecompra.js"></script>
    <script src="/js/app/models/habitacion.js"></script>
    <script src="/js/app/models/piso.js"></script>
    <script src="/js/app/models/tipohabitacion.js"></script>
    <script src="/js/app/routers/base.js"></script>
    <script src="/js/app/views/app-view.js"></script>
    <script src="/js/app/views/appcaja-view.js"></script>
    <script src="/js/app/views/detallecompra-view.js"></script>
    <script src="/js/app/views/habitacion-view.js"></script>
    <script src="/js/app/views/piso-view.js"></script>
    <script src="/js/app/views/tipohabitacion-view.js"></script>
    <!-- endinject -->
    <script src="/js/app/routers/base.js"></script>
	<script src="/assets/jsdev/main.js"></script>
	
</body>
</html></body>
</html>