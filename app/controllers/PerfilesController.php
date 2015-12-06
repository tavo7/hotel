<?php

class PerfilesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /perfiles
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$perfiles = Perfil::all();
		return View::make('perfiles.index', compact('perfiles'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /perfiles/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('perfiles.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /perfiles
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$perfil = Perfil::create(Input::all());

		return Redirect::to('/perfiles');
	}

	/**
	 * Display the specified resource.
	 * GET /perfiles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /perfiles/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id = NULL)
	{
		if (isset($id)) {
			$perfil = Perfil::find($id);
			return View::make('perfiles.edit', compact('perfil'));
		}else{
			return Redirect::to('/perfiles');
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /perfiles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit()
	{
		$perfil = Perfil::find(Input::get('perfil_id'));
		$perfil->update(Input::all());
		$perfil->save();
		return Redirect::to('/perfiles');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /perfiles/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDestroy($id = NULL)
	{
		if (isset($id)) {
			$perfil = Perfil::find($id);
			$perfil->delete();
			return Redirect::back();
		}else{
			return Redirect::back();
		}
	}

}