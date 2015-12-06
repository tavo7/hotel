<?php

class TipoGastoController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /tipogas
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$tiposdegasto = TipodeGasto::all();
		return View::make('tiposdegasto.index',compact('tiposdegasto'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /tipohabitacion/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		return View::make('tiposdegasto.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /tipohabitacion
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$tipogasto = TipodeGasto::create(Input::all());

		return Redirect::to('/tiposdegasto');
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
			$tipogasto = TipodeGasto::find($id);
			return View::make('tiposdegasto.edit', compact('tipogasto'));
		}else{
			return Redirect::to('/tiposdegasto');
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
		$tipogasto = TipodeGasto::find(Input::get('tipogasto_id'));

        $tipogasto->update(Input::all());
        $tipogasto->save();

		return Redirect::to("/tiposdegasto");
	}

}