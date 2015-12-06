<?php

class HabitacionesController extends \BaseController {

	public function getIndex()
	{
		$habitaciones = Habitacion::with(['precios','piso', 'tipo'])->get();
		return View::make('habitaciones.index', compact('habitaciones'));
	}

	public function getCreate()
	{
		$tiposhabitacion = Tipohabitacion::all()->lists('nombre', 'id');
		$pisos = Piso::all()->lists('nombre', 'id');
		return View::make('habitaciones.create', compact('tiposhabitacion', 'pisos'));
	}

	public function postCreate()
	{
		$habitacion = Habitacion::create(Input::all());
		$preciodia = PrecioHabitacion::create(['habitacion_id'=> $habitacion->id ,
					'descripcion'=>'día', 'precio'=>Input::get('costodia')]);
		$preciohora = PrecioHabitacion::create(['habitacion_id'=> $habitacion->id ,
					'descripcion'=>'hora', 'precio'=>Input::get('costohora')]);
		$precioespecial = PrecioHabitacion::create(['habitacion_id'=> $habitacion->id ,
					'descripcion'=>'especial', 'precio'=>Input::get('costoespecial')]);
		return Redirect::to('habitaciones');
	}

	public function getEdit($id = NULL)
	{
		if (isset($id)) {
			$habitacion = Habitacion::find($id);
			$tiposhabitacion = Tipohabitacion::all()->lists('nombre', 'id');
			$pisos = Piso::all()->lists('nombre', 'id');
			$preciodia = PrecioHabitacion::where('descripcion','=','dia')
						->where('habitacion_id','=',$habitacion->id)->first()->precio;
			$preciohora = PrecioHabitacion::where('descripcion','=','hora')
						->where('habitacion_id','=',$habitacion->id)->first()->precio;
			$especial = PrecioHabitacion::where('descripcion','=','especial')
						->where('habitacion_id','=',$habitacion->id)->first();
			if(!isset($especial)){
				$especial = PrecioHabitacion::create(['habitacion_id'=> $habitacion->id ,
					'descripcion'=>'especial', 'precio'=>0.00]);
				$precioespecial = $especial->precio;
			}else{
				$precioespecial = $especial->precio;
			}
			return View::make('habitaciones.edit',
						compact('tiposhabitacion', 'pisos', 'habitacion','preciodia',
							'precioespecial','preciohora'));
		}else{
			return Redirect::to('habitaciones');
		}
	}

	public function postEdit()
	{
		$habitacion = Habitacion::find(Input::get('habitacion_id'));
		$habitacion->update(Input::all());
		$habitacion->save();
		$preciodia = PrecioHabitacion::where('descripcion','=','dia')->where('habitacion_id','=',$habitacion->id)->first();
		$preciodia->precio = Input::get('costodia');
		$preciodia->save();
		$preciohora = PrecioHabitacion::where('descripcion','=','hora')->where('habitacion_id','=',$habitacion->id)->first();
		$preciohora->precio = Input::get('costohora');
		$preciohora->save();
		$precioespecial = PrecioHabitacion::where('descripcion','=','especial')->where('habitacion_id','=',$habitacion->id)->first();
		$precioespecial->precio = Input::get('costoespecial');
		$precioespecial->save();
		return Redirect::to('habitaciones');
	}

	public function getHabitacion(){
		$habitaciones = Habitacion::with(['precios','piso', 'tipo','pedidos'=>function($q){
											$q->where('estado', '=', 1);
											$q->get();
										}, 'pedidos.productos'=>function($q){
											$q->where('detallepedidoproductos.estado', '=', 1);
											$q->get();
										},
										'pedidos.alquiler'=>function($q){
											$q->where('detallepedidohabitacion.estado', '=', 1);
											$q->get();
										},'pedidos.persona' ])
						->orderby('nombre', 'asc')->get();
		return Response::json($habitaciones);
	}

	public function getMantenimiento(){
		$habitaciones = Habitacion::with(['mantenimiento'=>function($q){
							$q->where('detallemantenimiento.estado', '=', 1);
							$q->get();
						},'mantenimiento.persona'])
						->orderby('nombre', 'asc')
						->get();

		return View::make('habitaciones.mantenimiento', compact('habitaciones'));
	}

	public function getLimpieza($id = NULL){
		if (isset($id)) {
			$habitacion = Habitacion::find($id);
            //dd($habitacion->estado);
			if(Auth::user()->perfil_id == 3){
                if($habitacion->estado == 'Libre' || $habitacion->estado == 'Sucia'){
                    $habitacion->mantenimiento()->attach(Auth::user()->id,['estado'=>1,
                        'horainicio'=> date('Y-m-d H:i:s')]);
                    $habitacion->estado = 'Limpieza';
                    $habitacion->save();
                    return Redirect::back();
                }else{
                    return Redirect::back();
                }
			}else{
				return Redirect::back();
			}
		}else{
			return Redirect::back();
		}
	}

	public function getMantenimientoliberar($id = NULL){
		if (isset($id)) {
			$habitacion = Habitacion::find($id);
			$control = $habitacion->mantenimiento()->where('detallemantenimiento.estado', '=',1)->first();
			if(Auth::user()->perfil_id == 3 && $habitacion->estado == 'Limpieza' && $control->id ==  Auth::user()->id){
				$control->pivot->estado = 0;
				$control->pivot->horatermino = date('Y-m-d H:i:s');
				$control->pivot->save();
				$flagpedido = $habitacion->pedidos()->where('pedido.estado','=',1)->first();
				if (count($flagpedido) > 0) {
					$habitacion->estado = 'Ocupada';
				}else{
					$habitacion->estado = 'Libre';
				}
				$habitacion->save();
				return Redirect::back();
			}else{
				return Redirect::back();
			}
		}else{
			return Redirect::back();
		}
	}
}