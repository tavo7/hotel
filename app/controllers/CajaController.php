<?php

class CajaController extends \BaseController {

	protected $detallecaja;

	public function __construct() {
		$caja = Caja::first();
		$this->detallecaja = $caja->detallecaja()->where('estado', '=', 'Abierto')->first();
	}

	/**
	 * Display a listing of the resource.
	 * GET /caja
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		if (isset($this->detallecaja)) {
			return View::make('caja.index');
		}else{
			$caja = Caja::where('estado', '=', 1)->lists('nombre', 'id');
			return View::make('caja.abrircaja', compact('caja'));
		}
	}

	public function postIndex(){
		$caja_id = Input::get('caja_id');
		$caja = Caja::find($caja_id);
		$datos = ['usuario_id'=>Auth::user()->id, 'montoinicial'=>Input::get('montoinicial'),
					'caja_id'=>$caja->id,'fechainicio'=>date('Y-m-d H:i:s')];
		$detallecaja=  Detallecaja::create($datos);
		$caja->estado = 0;
		$caja->save();
		return Redirect::to('/caja');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /caja/create
	 *
	 * @return Response
	 */
	public function getHabitacionOrder($id=NULL)
	{
		if (isset($id)) {
			$habitacion = Habitacion::find($id);
			$precios = $habitacion->precios;
			$pedido = $habitacion->pedidos()
						->where('pedido.estado', '=', 1)
						->first();
			if (count($pedido) > 0) {
				$persona = $pedido->persona()->first();
				$productos = $pedido->productos()->where('detallepedidoproductos.estado', '!=', 2)->get();
				$alquiler = $pedido->alquiler()->where('detallepedidohabitacion.estado', '!=', 2)->get();
				$pagado = $pedido->documentoventa()->sum('importe');
				$pagarpro = $pedido->productos()
							->where('detallepedidoproductos.estado', '=', 1)->sum('detallepedidoproductos.precio');
				$pagaralquiler = $pedido->alquiler()
							->where('detallepedidohabitacion.estado', '=', 1)->sum('detallepedidohabitacion.precio');
				$porpagar = $pagarpro + $pagaralquiler;
				$tiposdecomprobante =Tipodecomprobante::all()->lists('nombre','id');
			}
			$categorias = Categoria::with(['productos'])
						->where('id','>', 1)->get();
			return View::make('cajas.habitacion', compact('habitacion', 'pedido', 'persona', 'productos',
							'alquiler', 'pagado', 'porpagar','categorias', 'tiposdecomprobante','precios'));
		}else{
			return Redirect::to('/cajas');
		}
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /caja
	 *
	 * @return Response
	 */
	public function postHabitacionOrder()
	{
		$persona_id = Input::get('persona_id');
		$control= Input::get('control');
		$cantidad = Input::get('cantidad');
		if ($cantidad == '') {
			return Redirect::back();
		}
		if(Input::get('nombre') == '' || Input::get('dni') == '' || Input::get('huespedes') == '')
		{
			return Redirect::back();
		}
		$habitacion = Habitacion::find(Input::get('habitacion_id'));
		if ($persona_id == '') {
			$persona = Persona::create(Input::all());
			$persona_id = $persona->id;
		}

		$pedido = Pedido::create([
			'estado'=>1,
			'fechainicio'=>date('Y-m-d H:i:s'),
			'habitacion_id'=>Input::get('habitacion_id'),
			'usuario_id'=>Auth::user()->id,
			'html5date'=>date('Y-m-d\TH:i:s\Z')
			]);
		$precio = $habitacion->precios()->where('descripcion','=',Input::get('control'))->first();

		$pedido->persona()->attach($persona_id,['numerodehuespedes'=>Input::get('huespedes'),
									'fechaentrada'=>date('Y-m-d H:i:s')]);
		if ($control == 'especial') {
			$control = 'dia';
		}
		if ($control == 'dia') {
			if (in_array(strtotime(date('H:i:s')), range(strtotime('04:00:00'),strtotime('13:00:00')))) {
				$fechacontrol = date('Y-m-d 13:00:00');
			}elseif (in_array(strtotime(date('H:i:s')), range(strtotime('00:00:00'),strtotime('03:59:00')))){
				$fechacontrol = date('Y-m-d', strtotime('-1 day')).' 13:00:00' ;
			}else{
				$fechacontrol = date('Y-m-d 13:00:00');
			}
			$precioimporte= $precio->precio * Input::get('cantidad');
		}
		else
		{
			$fechacontrol= date('Y-m-d H:i:s');
			$precioimporte= $precio->precio * Input::get('cantidad') + $precio->precio;
		}

		$pedido->alquiler()->attach($precio->id, ['cantidad'=>$cantidad,
									'control'=>$control,
									'descripcion'=>$precio->descripcion,
									'estado'=> 1,
									'fechacontrol'=>$fechacontrol,
									'precio'=>$precioimporte]);
		$habitacion->estado = 'Ocupada';
		$habitacion->save();
		return Redirect::to('/caja/habitacion-order/'.$habitacion->id);
	}

	/**
	 * Display the specified resource.
	 * GET /caja/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postCobrar()
	{
		$pedido = Pedido::find(Input::get('pedido_id'));
		$pagarpro = $pedido->productos()
							->where('detallepedidoproductos.estado', '=', 1)->sum('detallepedidoproductos.precio');
		$pagaralquiler = $pedido->alquiler()
					->where('detallepedidohabitacion.estado', '=', 1)->sum('detallepedidohabitacion.precio');
		$porpagar = $pagarpro + $pagaralquiler;
		$persona_id = Input::get('persona_id');
        $credito = Input::get('credito');
        $creditos = $pedido->creditos()->get();
        $importecreditos = 0;
        $persona = Persona::find(Input::get('persona_id'));
        foreach($creditos as $item){
            $importecreditos = $importecreditos + $item->importe;
        }
        if($importecreditos == $porpagar){
            $porpagar = 0;
        }
		if ($porpagar  == 0) {
			return Redirect::back();
		}

		if(Input::get('tipocomprobante_id') == 3){
			if (Input::get('persona_id')== '') {
				if (strlen(Input::get('dniruc')) < 11) {
					return Redirect::back();
				}
				if(Input::get('nombre') != '')
				{
					$persona = Persona::create(['ruc'=> Input::get('dniruc') ,
												'razonsocial'=>Input::get('nombre')]);
					$persona_id = $persona->id;
				}
				else
				{
					return Redirect::back();
				}
			}
		}

        if($credito == 1){
            $empresa = '';
            $ruc = '';
            if(count($persona) > 0){
                $empresa = $persona->razonsocial;
                $ruc = $persona->ruc;
            }
            $cliente = $pedido->persona()->first();
            $detcredito = Credito::create([
                            'pedido_id'=> $pedido->id,
                            'estado'=> $credito,
                            'nombre'=> $cliente->nombre,
                            'dni'=>$cliente->dni,
                            'empresa'=> $empresa,
                            'ruc'=> $ruc,
                            'detallecaja_id' => $this->detallecaja->id,
                            'importe'=> $porpagar]);

            return Redirect::back();
        }
		$importe = Input::get('importe');
		$subtotal = $importe/1.18;
		$documentoventa = Documentoventa::create(['estado' => 1,
												  'igv'=> $importe - $subtotal,
												  'importe' => $importe,
												  'subtotal' => $subtotal,
												  'caja_id' => $this->detallecaja->caja_id,
												  'detallecaja_id' => $this->detallecaja->id,
												  'pedido_id' =>Input::get('pedido_id'),
												  'persona_id' => $persona_id,
												  'tipocomprobante_id' =>Input::get('tipocomprobante_id'),
												  'numero' =>Input::get('serie'),
												  'serie' =>Input::get('numero')]);
		$productos = $pedido->productos;
		$alquiler = $pedido->alquiler;
		foreach ($productos as $producto) {
			if ($producto->pivot->estado == 1) {
				$producto->pivot->estado = 0;
				$documentoventa->productos()
								->attach($producto->id,['precio' => $producto->pivot->precio,
														'preciounitario' => $producto->pivot->preciounitario,
														'cantidad' => $producto->pivot->cantidad ,
														'descripcion' => $producto->nombre]);
				$producto->pivot->save();
			}
		}

		foreach ($alquiler as $detalle) {
			if ($detalle->pivot->estado == 1) {
				$detalle->pivot->estado = 0;
				$documentoventa->alquiler()
								->attach($detalle->id,['precio' => $detalle->pivot->precio,
														'preciounitario' => $detalle->pivot->precio/$detalle->pivot->cantidad,
														'cantidad' => $detalle->pivot->cantidad ,
														'descripcion' => $detalle->descripcion]);
				$detalle->pivot->save();
			}
		}

		return Redirect::back();
	}

	public function getCheckout($id = NULL)
	{
		if (isset($id)) {
			$pedido = Pedido::find($id);
			$pagarpro = $pedido->productos()
							->where('detallepedidoproductos.estado', '=', 1)->sum('detallepedidoproductos.precio');
			$pagaralquiler = $pedido->alquiler()
						->where('detallepedidohabitacion.estado', '=', 1)->sum('detallepedidohabitacion.precio');
			$porpagar = $pagarpro + $pagaralquiler;
            $creditos = $pedido->creditos()->get();
            $importecreditos = 0;
            foreach($creditos as $item){
                $importecreditos = $importecreditos + $item->importe;
            }
            if($porpagar == $importecreditos){
                $porpagar = 0;
            }
			if ($porpagar  > 0) {
				return Redirect::back();
			}
			$alquiler = $pedido->persona()->first();
			$habitacion = $pedido->habitacion;
			$alquiler->pivot->fechasalida = date('Y-m-d H:i:s');
			$alquiler->pivot->save();
			$habitacion->estado = 'Sucia';
			$habitacion->save();
			$pedido->estado =2;
			$pedido->fechafin = date('Y-m-d H:i:s');
			$pedido->save();
			return View::make('caja.ckeckout', compact('pedido','habitacion','alquiler'));
		}else{
			return Redirect::back();
		}
	}

	public function getVentaDirecta()
	{
		$categorias = Categoria::with(['productos'])
						->where('id','>', 1)->get();
		return View::make('caja.ventadirecta', compact('categorias'));
	}

	public function postVentadirecta()
	{
		$pedido = Pedido::create([
			'estado'=>2,
			'fechainicio'=>date('Y-m-d H:i:s'),
			'usuario_id'=>Auth::user()->id
			]);
		$productos = Input::get('productos');
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
		$pagarpro = $pedido->productos()
							->where('detallepedidoproductos.estado', '=', 1)->sum('detallepedidoproductos.precio');


		$subtotal = $pagarpro/1.18;
		$documentoventa = Documentoventa::create(['estado' => 1,
												  'igv'=> $pagarpro - $subtotal,
												  'importe' => $pagarpro,
												  'subtotal' => $subtotal,
												  'caja_id' => $this->detallecaja->caja_id,
												  'detallecaja_id' => $this->detallecaja->id,
												  'pedido_id' =>$pedido->id,
												  'tipocomprobante_id' =>1]);
		$productos = $pedido->productos;
		foreach ($productos as $producto) {
			if ($producto->pivot->estado == 1) {
				$producto->pivot->estado = 0;
				$documentoventa->productos()
								->attach($producto->id,['precio' => $producto->pivot->precio,
														'preciounitario' => $producto->pivot->preciounitario,
														'cantidad' => $producto->pivot->cantidad ,
														'descripcion' => $producto->nombre]);
				$producto->pivot->save();
			}
		}
		return Response::json(['estado'=>true,'msg'=>'Operacion Completada Correctamente']);
	}

	public function getRegistrarGasto()
	{
		$tipodegastos = TipodeGasto::lists('nombre','id');
		return View::make('caja.registrargasto', compact('tipodegastos'));
	}

	public function postRegistrarGasto()
	{
		$gasto = Gasto::create([
			'importetotal' => Input::get('importetotal'),
			'detallecaja_id' => $this->detallecaja->id,
			'tipogasto_id' => Input::get('tipodegasto_id'),
			'descripcion'=>Input::get('descripcion'),
			'numero'=>Input::get('numero'),
			'serie' => Input::get('serie')
			]);
		return Redirect::to('/caja');
	}

	public function getRegistrarIngreso()
	{
		return View::make('caja.registraringreso');
	}

	public function postRegistrarIngreso()
	{
		$ingreso = Ingreso::create([
			'importetotal'=>Input::get('importetotal'),
			'descripcion'=>Input::get('descripcion'),
			'detallecaja_id'=>$this->detallecaja->id
			]);
		return Redirect::to('/caja');
	}

	public function getCerrarCaja()
	{
		if (!isset($this->detallecaja)) {
			return Redirect::to('/');
		}
		$detallecaja = $this->detallecaja;
		$ventas = $this->detallecaja->ventas()->sum('importe');
		$ingresos = $this->detallecaja->ingresos()->sum('importetotal');
		$gastos = $this->detallecaja->gastos()->sum('importetotal');
		return View::make('caja.cerrarcaja', compact('detallecaja', 'ventas', 'ingresos', 'gastos'));
	}

	public function postCerrarCaja()
	{
		$caja = $this->detallecaja->caja;
		$ingresoscaja = $this->detallecaja->ingresos()->sum('importetotal');
		$montoinicial = $this->detallecaja->montoinicial;
		$encargado = Auth::user()->persona;
		$fechacierre = date('Y-m-d H:i:s');
		$detallecaja = $this->detallecaja;
        $diferencia = Input::get('diferencia');
		$habitaciones = Habitacion::with(['mantenimiento'=>function($q){
							$q->whereBetween('horatermino', [$this->detallecaja->created_at,
								date('Y-m-d H:i:s')]);
							$q->get();
						},'mantenimiento.persona'])
						->orderby('nombre', 'asc')
						->get();
		$this->detallecaja->ventas = $this->detallecaja->ventas()->sum('importe');
		$this->detallecaja->gastos = $this->detallecaja->gastos()->sum('importetotal');
		$this->detallecaja->ingresos = $ingresoscaja;
		$this->detallecaja->arqueo = Input::get('arqueo');
		$this->detallecaja->diferencia = $diferencia;
		$this->detallecaja->estado = 'Cerrado';
		$this->detallecaja->fechacierre = $fechacierre;
		$this->detallecaja->save();
		$caja->estado = 1;
		$caja->save();
		$alquileres = $this->detallecaja->ventas()->with([
						'alquiler',
						'alquiler.habitacion',
						'productos'
					])->get();
        $creditos = $this->detallecaja->creditos()->with([
                        'pedido','pedido.habitacion'
                    ])->get();
		$gastos = $this->detallecaja->gastos()->with(['tipogasto'])->get();
		$html = View::make('pdf.cierrecaja',
				compact('alquileres', 'gastos','ingresoscaja','montoinicial','encargado', 
					'fechacierre', 'detallecaja','habitaciones','diferencia','creditos'));
		$headers = array('Content-Type' => 'application/pdf');
		return Response::make(PDF::load($html, 'A4', 'portrait')->show(), 200, $headers);
	}

	public function getVentas()
	{
        $alquileres = $this->detallecaja->ventas()->with([
            'alquiler',
            'alquiler.habitacion',
            'productos',
            'pedido'
        ])->get();

		return View::make('caja.listaventas', compact('alquileres'));
	}

	public function getGastos()
	{
		$items = $this->detallecaja->gastos()->get();
		$total = $this->detallecaja->gastos()->sum('importetotal');

		return View::make('caja.listagastos', compact('items', 'total'));
	}

	public function getIngresos()
	{
		$items = $this->detallecaja->ingresos()->get();
		$total = $this->detallecaja->ingresos()->sum('importetotal');

		return View::make('caja.listaingresos', compact('items', 'total'));
	}

    public function getCobrarcredito(){
        $creditos = Credito::where('estado', '=',1)
                    ->with(['pedido','pedido.habitacion'])
                    ->get();
        return View::make('caja.cobrarcredito', compact('creditos'));
    }

    public function getCobrarDeuda($id = NULL){
        if(isset($id)){
            $credito = Credito::find($id);
            if($credito->ruc > 0){
                $persona = Persona::where('ruc', '=', $credito->ruc)->first();
                $tipocomprobante = 3;
            }else{
                $persona = Persona::where('dni', '=', $credito->dni)->first();
                $tipocomprobante = 2;
            }
            $pedido = $credito->pedido;
            $importe = $credito->importe;
            $subtotal = $importe/1.18;
            $documentoventa = Documentoventa::create(['estado' => 1,
                'igv'=> $importe - $subtotal,
                'importe' => $importe,
                'subtotal' => $subtotal,
                'caja_id' => $this->detallecaja->caja_id,
                'detallecaja_id' => $this->detallecaja->id,
                'pedido_id' =>$pedido->id,
                'persona_id' => $persona->id,
                'tipocomprobante_id' =>$tipocomprobante]);
            $productos = $pedido->productos;
            $alquiler = $pedido->alquiler;
            foreach ($productos as $producto) {
                if ($producto->pivot->estado == 1) {
                    $producto->pivot->estado = 0;
                    $documentoventa->productos()
                        ->attach($producto->id,['precio' => $producto->pivot->precio,
                            'preciounitario' => $producto->pivot->preciounitario,
                            'cantidad' => $producto->pivot->cantidad ,
                            'descripcion' => $producto->nombre]);
                    $producto->pivot->save();
                }
            }

            foreach ($alquiler as $detalle) {
                if ($detalle->pivot->estado == 1) {
                    $detalle->pivot->estado = 0;
                    $documentoventa->alquiler()
                        ->attach($detalle->id,['precio' => $detalle->pivot->precio,
                            'preciounitario' => $detalle->pivot->precio/$detalle->pivot->cantidad,
                            'cantidad' => $detalle->pivot->cantidad ,
                            'descripcion' => $detalle->descripcion]);
                    $detalle->pivot->save();
                }
            }
            $credito->estado = 0;
            $credito->save();
            return Redirect::back();

        }else{
            return Redirect::back();
        }
    }
}