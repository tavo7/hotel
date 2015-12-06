<?php

class PersonaController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /persona
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$personas = Persona::all();
		return View::make('persona.index', compact('personas'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /persona/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('persona.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /persona
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$newpesona = Persona::create(Input::all());

		return Redirect::to('/persona');
	}

	/**
	 * Display the specified resource.
	 * GET /persona/{id}
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
	 * GET /persona/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id= NULL)
	{
		if(isset($id)){
			$persona = Persona::find($id);
			return View::make('persona.edit', compact('persona'));
		}else{
			return Redirect::to('persona');
		}
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /persona/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function postEdit()
	{
		$idpersona = Input::get('persona_id');
		$persona = Persona::find($idpersona);
		$persona->update(Input::all());
		$persona->save();
		return Redirect::to('/persona');
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /persona/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getDestroy($id = NULL)
	{
		if (isset($id)) {
			$persona = Persona::find($id);
			$persona->delete();
			return Redirect::back();
		}else{
			return Redirect::back();
		}
	}

}