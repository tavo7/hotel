<?php

class TipoHabitacionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /tipohabitacion
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$tiposhabitacion = Tipohabitacion::all();
		return View::make('tiposhabitacion.index',compact('tiposhabitacion'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tipohabitacion/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('tiposhabitacion.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tipohabitacion
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$tipohabitacion = Tipohabitacion::create(Input::all());

		return Redirect::to('/tiposhabitacion');
	}

	/**
	 * Display the specified resource.
	 * GET /tipohabitacion/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id = NULL)
	{
		if (isset($id)) {
			$tipohabitacion = Tipohabitacion::find($id);
			return View::make('tiposhabitacion.edit', compact('tipohabitacion'));
		}else{
			return Redirect::to('/tiposhabitacion');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /tipohabitacion/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit()
	{
		$tipohabitacion = Tipohabitacion::find(Input::get('tipohabitacion_id'));

		$tipohabitacion->update(Input::all());
		$tipohabitacion->save();

		return Redirect::to("/tiposhabitacion");
	}

	public function getTipoHabitacion(){
		$tiposhabitacion = Tipohabitacion::all();
		return Response::json($tiposhabitacion);
	}

}