<?php

class ProductosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /productos
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$productos = Producto::where('categoria_id', '>', 1)->get();
		$total = 0;
		foreach ($productos as $producto) {
			$newcant = $producto->precioventa*$producto->stockactual;
			$total = $total + $newcant ;
		}
		return View::make('productos.index', compact('productos', 'total'));
	}

	public function getProductosinterno()
	{
		$productos = Producto::where('categoria_id', '=', 1)->get();
		$total = 0;
		foreach ($productos as $producto) {
			$newcant = $producto->precioventa*$producto->stockactual;
			$total = $total + $newcant ;
		}
		return View::make('productos.index', compact('productos','total'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /productos/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$unidades = Unidadmedida::all()->lists('nombre', 'id');
		$categorias = Categoria::where('id', '>', 1)->lists('nombre', 'id');

		return View::make('productos.create', compact('unidades', 'categorias'));
	}

	public function getCreate2()
	{
		$unidades = Unidadmedida::all()->lists('nombre', 'id');
		$categorias = Categoria::where('id', '>', 1)->lists('nombre', 'id');
		return View::make('productos.create', compact('unidades', 'categorias'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /productos
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$producto = Producto::create(Input::all());
		return Redirect::to('productos');
	}

	public function postCreate2()
	{
		$producto = Producto::create(Input::all());
		return Redirect::to('productos/productosinterno');
	}

	/**
	 * Display the specified resource.
	 * GET /productos/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id = NULL)
	{
		if (isset($id)) {
			$producto = Producto::find($id);
			$unidades = Unidadmedida::all()->lists('nombre', 'id');
			$categorias = Categoria::where('id', '>', 1)->lists('nombre', 'id');

			return View::make('productos.edit', compact('producto', 'categorias', 'unidades'));
		}else{
			return Redirect::to('/productos');
		}
	}

	public function getEdit2($id = NULL)
	{
		if (isset($id)) {
			$producto = Producto::find($id);
			$unidades = Unidadmedida::all()->lists('nombre', 'id');
			$categorias = Categoria::where('id', '>', 1)->lists('nombre', 'id');

			return View::make('productos.edit', compact('producto', 'categorias', 'unidades'));
		}else{
			return Redirect::to('/productos');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /productos/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit()
	{
		$producto = Producto::find(Input::get('producto_id'));
		$producto->update(Input::all());
		$producto->save();
		return Redirect::to('productos');
	}

	public function postEdit2()
	{
		$producto = Producto::find(Input::get('producto_id'));
		$producto->update(Input::all());
		$producto->save();
		return Redirect::to('productos');
	}

	public function getBuscarproductos(){
		$patron = Input::get('q');
		$productos = Producto::select('producto.nombre', 'unidadmedida.alias', 'producto.id')
					->join('unidadmedida','unidadmedida.id','=','producto.unidadmedida_id')
					->where('producto.nombre', 'like',$patron.'%')->get();
		return Response::json($productos);
	}

	public function getProducto()
	{
		$productos = Producto::where('categoria_id','>', 1)->get();
		return Response::json($productos);
	}

	public function getDestroy($id = NULL)
	{
		if (isset($id)) {
			$producto = Producto::find($id);
			$producto->delete();
			return Redirect::back();
		}else{
			return Redirect::back();
		}
	}
}