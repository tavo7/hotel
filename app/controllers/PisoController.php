<?php

class PisoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /piso
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$pisos = Piso::all();

		return View::make('pisos.index', compact('pisos'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /piso/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('pisos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /piso
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$piso = Piso::create(Input::all());
		 return Redirect::to('/pisos');
	}

	/**
	 * Display the specified resource.
	 * GET /piso/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id= NULL)
	{
		if (isset($id)) {
			$piso = Piso::find($id);
			return View::make('pisos.edit', compact('piso'));
		}else{
			return Redirect::to('/pisos');
		}
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /piso/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit()
	{
		$piso = Piso::find(Input::get('piso_id'));
		$piso->update(Input::all());
		$piso->save();
		return Redirect::to('/pisos');
	}

	public function getPiso(){
		$pisos = Piso::all();
		return Response::json($pisos);
	}

}