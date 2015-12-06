<?php

class ComprasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /compras
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$compras = Compras::all();
		 return View::make('compras.index', compact('compras'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /compras/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$tiposdecomprobante =Tipodecomprobante::all()->lists('nombre','id');
		return View::make('compras.create', compact('tiposdecomprobante'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /compras
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		DB::beginTransaction();
		try {
			$compra = Compras::create(Input::all());
			$compra->fecha = $compra->created_at;
			$productos = Input::get('productos');
			foreach ($productos as $producto) {
				if ($producto['producto_id'] > 0) {
					if ($producto['preciototal']> 0) {
						$oproducto = Producto::find($producto['producto_id']);
						$compra->productos()->attach($oproducto->id, 
								array('preciocompra'=>$producto['preciocompra'],
									'cantidad'=> $producto['cantidad'], 
									'cantidadtotal'=> $producto['cantidadtotal'],
									'preciototal' =>$producto['preciototal'], 
									'preciounitario' =>$producto['preciounitario'], 
									'presentacion'=>$producto['presentacion'],
									'unidadmedida'=>$producto['unidadmedida']));
						$oproducto->costo = $producto['preciocompra'];
						$oproducto->stockactual = $oproducto->stockactual + $producto['cantidadtotal'];
						$oproducto->save();
					}else{
						return Response::json(array('estado'=>false, 'msg'=>'Productos con precios 0.00'));
					}
				}else{
					return Response::json(array('estado'=>false, 'msg'=>'No has Selecionado un producto'));
				}
			}
			$compra->save();
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false, 'msg'=> $e, 'error'=> 1));
		}
		DB::commit();
		return Response::json(array('estado' => true, 'msg'=> 'Operacion completada Correctamente'));
	}

	/**
	 * Display the specified resource.
	 * GET /compras/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDetalle($id=NULL)
	{
		if (isset($id)) {
			$compra= Compras::find($id);
			$productos = $compra->productos;
			return View::make('compras.detalle', compact('compra', 'productos'));
		}else{
			return Redirect::to('/compras');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /compras/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id = NULL)
	{
		if (isset($id)) {
			$compra = Compras::select('compra.igv','compra.subtotal','compra.total','compra.id', 
						'compra.provedor_id','compra.tipocomprobante_id','compra.fecha','compra.created_at', 
						'compra.updated_at','compra.usuario_id','compra.serie','compra.numero',
						'persona.razonsocial')
					->where('compra.id', '=', $id)
					->leftjoin('persona', 'persona.id', '=', 'compra.provedor_id')
					->first();
			$productos = $compra->productos;
			$tiposdecomprobante =Tipodecomprobante::all()->lists('nombre','id');
			return View::make('compras.edit',compact('compra', 'productos','tiposdecomprobante'));
		}else{
			return Redirect::to('compras');
		}
	}

	public function postEdit()
	{
		DB::beginTransaction();	
		try {
			$compra = Compras::find(Input::get('compra_id'));
			$compra->productos()->detach();
			$productos = Input::get('productos');
			foreach ($productos as $producto) {
				if ($producto['producto_id'] > 0) {
					if ($producto['preciototal']> 0) {
						$oproducto = Producto::find($producto['producto_id']);
						$compra->productos()->attach($oproducto->id, 
								array('preciocompra'=>$producto['preciocompra'],
									'cantidad'=> $producto['cantidad'], 
									'cantidadtotal'=> $producto['cantidadtotal'],
									'preciototal' =>$producto['preciototal'], 
									'preciounitario' =>$producto['preciounitario'], 
									'presentacion'=>$producto['presentacion'],
									'unidadmedida'=>$producto['unidadmedida']));
						$oproducto->costo = $producto['preciocompra'];
						$oproducto->stockactual = $oproducto->stockactual + $producto['cantidadtotal'];
						$oproducto->save();
					}else{
						return Response::json(array('estado'=>false, 'msg'=>'Productos con precios 0.00'));
					}
				}else{
					return Response::json(array('estado'=>false, 'msg'=>'No has Selecionado un producto'));
				}
			}
			$compra->update(Input::all());
			$compra->save();
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('estado' => false, 'msg'=> $e, 'error'=> 1));
		}
		DB::commit();
		return Response::json(array('estado' => true, 'msg'=> 'Operacion completada Correctamente'));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /compras/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}