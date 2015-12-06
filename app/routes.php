<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', function () {
	return Redirect::to('login');
});

Route::get('login', function () {
	if (Auth::check()) {
		return View::make('login.welcome');
	} else {
		return View::make('login.index');
	}
});

Route::post('login', function () {
	if (Auth::attempt(array('login' => Input::get('login'), 'password' => Input::get('password'), 'estado' => 1), true)) {
		return View::make('login.welcome');
	} else {
		return Redirect::to('login')->with('mensaje_login', 'Ingreso invalido');
	}
});

Route::get('logout', function () {
		if (Auth::check()) {
			Auth::logout();
			return Redirect::to('login');
		} else {
			return Redirect::to('login');
		}
});

Route::controller('persona', 'PersonaController');
Route::controller('perfiles', 'PerfilesController');
Route::controller('usuarios', 'UsuariosController');
Route::controller('unidadesmedida', 'UnidadesmedidaController');
Route::controller('categorias', 'CategoriasController');
Route::controller('productos', 'ProductosController');
Route::controller('compras', 'ComprasController');
Route::controller('pisos', 'PisoController');
Route::controller('tiposhabitacion', 'TipoHabitacionController');
Route::controller('habitaciones', 'HabitacionesController');
Route::controller('caja', 'CajaController');
Route::controller('tiposdegasto', 'TipoGastoController');
Route::controller('reportes', 'ReportesController');

Route::post('crear_empresa',function(){
	if (Request::ajax()) {
		$empresa = Persona::create(Input::all());
		return Response::json($empresa);
	}
});

Route::get('empresas',function(){
	if (Request::ajax()) {
		$patron = Input::get('q');
		$empresas = Persona::where('razonsocial', 'like', $patron.'%')
					->orWhere('ruc', 'like', $patron.'%')
					->get();
		return Response::json($empresas);
	}
});

Route::get('personas',function(){
	if (Request::ajax()) {
		$patron = Input::get('q');
		$empresas = Persona::where('nombre', 'like', $patron.'%')
					->orWhere('dni', 'like', $patron.'%')
					->orWhere('ruc','like', $patron.'%')
					->orWhere('razonsocial', 'like', $patron.'%')
					->get();
		return Response::json($empresas);
	}
});

Route::post('ordenarproductos', function(){
	if (Request::ajax()) {
		$pedido_id = Input::get('pedido_id');
		$productos = Input::get('productos');
		$pedido = Pedido::find($pedido_id);
		foreach ($productos as $producto) {
			$cantidad = $producto['cantidad'];
			$pedido->productos()->attach($producto['producto_id'],
				['cantidad'=>$cantidad, 'estado'=>1, 'precio'=>$producto['precio'],
				'preciounitario'=>$producto['preciounitario']]);
			$producto = Producto::find($producto['producto_id']);
			$newstock = $producto->stockactual - $cantidad;
			$producto->stockactual = $newstock;
			$producto->save();
		}
		return Response::json(['estado'=>true,'msg'=>'Operacion Completada Correctamente']);
	}
});

Route::post('anularalquiler', function(){
	if (Request::ajax()) {
		$pedido = Pedido::find(Input::get('pedido_id'));
		$producto = Alquiler::find(Input::get('detalleid'));
		$producto->estado = 2;
		$producto->motivo = Input::get('motivo');
		$producto->save();
		return Response::json(['estado'=>true,'msg'=>'Operacion Completada Correctamente']);
	}
});

Route::post('editaralquiler', function(){
    if (Request::ajax()) {
        $pedido = Pedido::find(Input::get('pedido_id'));
        $alquiler = Alquiler::find(Input::get('detalleid'));
        $alquiler->precio = Input::get('precio');
        $alquiler->descripcion = Input::get('descripcion');
        $alquiler->save();
        return Response::json(['estado'=>false,'msg'=>'Operacion Completada Correctamente']);
    }
});



Route::post('anularproducto', function(){
	if (Request::ajax()) {
		$pedido = Pedido::find(Input::get('pedido_id'));
		$producto = $pedido->productos()
					->where('detallepedidoproductos.id','=',Input::get('detalleid'))
					->first();

		$producto->pivot->estado = 2;
		$producto->pivot->motivo = Input::get('motivo');
		$producto->pivot->save();
		return Response::json(['estado'=>true,'msg'=>'Operacion Completada Correctamente']);
	}
});

Route::post('controlhabitacion',function(){
	if (Request::ajax()) {
		$pedido = Pedido::find(Input::get('pedido_id'));
		$alquileres = $pedido->alquiler()->get();
		$habitacion = $pedido->habitacion;
		$preciohora = PrecioHabitacion::where('descripcion','=','hora')->where('habitacion_id','=',$habitacion->id)->first();
		$preciodia = PrecioHabitacion::where('descripcion','=','dia')->where('habitacion_id','=',$habitacion->id)->first();
		foreach ($alquileres as $alquiler) {
            $oalquiler = Alquiler::find($alquiler->pivot->id);
			if ($alquiler->pivot->control != 'nulo') {
				$control = DB::select(DB::raw("SELECT TIMESTAMPDIFF(HOUR, fechacontrol, now()) AS
										control FROM detallepedidohabitacion WHERE id
										=".$alquiler->pivot->id." LIMIT 1"));
				$tiempotrasncurrido = 0;
				foreach ($control as $item) {
					$tiempotrasncurrido = $item->control;
				}
				$cantidad = $alquiler->pivot->cantidad;
				if ($alquiler->pivot->control == 'hora') {
					$diferencia = $tiempotrasncurrido - $cantidad;
					if($diferencia >= 0){
						if($diferencia == 0){
							$diferencia = 1;
						}
						$newprecio = $alquiler->pivot->precio + $preciohora->precio*$diferencia;

						if($newprecio > $preciodia->precio){
							$oalquiler->precio = $preciodia->precio;
							$oalquiler->descripcion = 'dia';
							$oalquiler->cantidad = 1;
							$oalquiler->fechacontrol = date('Y-m-d 13:00:00');
							$oalquiler->control = 'dia';
							$oalquiler->save();
						}else{
							$oalquiler->precio = $newprecio;
							$oalquiler->cantidad = $cantidad + 1;
							$oalquiler->save();
						}
					}
				}elseif ($alquiler->pivot->control == 'dia') {
					$diferencia = $tiempotrasncurrido - $cantidad*24;
                    $dias = floor($diferencia/24);
                    $horas = $diferencia%24;
					if ($diferencia >= 0) {
						if($diferencia == 0){
                            $horas = 1;
						}elseif($dias > 0){
                            $pedido->alquiler()->attach($preciohora->id, ['cantidad'=>$dias,
                                'control'=>'ninguno',
                                'descripcion'=>'dia',
                                'estado'=> 1,
                                'fechacontrol'=>date('Y-m-d 13:00:00'),
                                'precio'=>$preciodia->precio*$dias]);
                        }
						$oalquiler->control = 'sincontrol';
						$oalquiler->save();
						$pedido->alquiler()->attach($preciohora->id, ['cantidad'=>$horas,
									'control'=>'hora',
									'descripcion'=>'hora',
									'estado'=> 1,
									'fechacontrol'=>date('Y-m-d 13:00:00'),
									'precio'=>$preciohora->precio*$horas]);
					}
				}
			}
		}
	}
});