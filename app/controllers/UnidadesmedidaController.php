<?php

class UnidadesmedidaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /unidadesmedida
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$unidades = Unidadmedida::all();
		return View::make('unidadesmedida.index', compact('unidades'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /unidadesmedida/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('unidadesmedida.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /unidadesmedida
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$unidadmedida = Unidadmedida::create(Input::all());
		 return Redirect::to('/unidadesmedida');
	}

	/**
	 * Display the specified resource.
	 * GET /unidadesmedida/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id = NULL)
	{
		if (isset($id)) {
			$unidad = Unidadmedida::find($id);
			return View::make('unidadesmedida.edit', compact('unidad'));
		}else{
			return Redirect::to('unidadesmedida');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /unidadesmedida/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit()
	{
		$unidad_id = Input::get('unidad_id');
		$unidadmedida = Unidadmedida::find($unidad_id);
		$unidadmedida->update(Input::all());
		$unidadmedida->save();

		return Redirect::to('unidadesmedida');
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /unidadesmedida/{id}
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
	 * DELETE /unidadesmedida/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}