<?php

class CategoriasController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /categorias
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$categorias = Categoria::where('id', '>', 1)->get();
		return View::make('categorias.index', compact('categorias'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /categorias/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('categorias.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /categorias
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$categoria = Categoria::create(Input::all());

		return Redirect::to('categorias');
	}

	/**
	 * Display the specified resource.
	 * GET /categorias/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id = NULL)
	{
		if (isset($id)) {
			$categoria = Categoria::find($id);
			return View::make('categorias.edit', compact('categoria'));
		}else{
			return Redirect::to('/categorias');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /categorias/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit()
	{
		$categoria_id = Input::get('categoria_id');
		$categoria = Categoria::find($categoria_id);
		$categoria->update(Input::all());
		$categoria->save();
		return Redirect::to('categorias'); 
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /categorias/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /categorias/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}