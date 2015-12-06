<?php

class UsuariosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /usuarios
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$usuarios = Usuario::all();

		return View::make('usuarios.index', compact('usuarios'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /usuarios/create
	 *
	 * @return Response
	 */
	public function getCreate()
	{
		$perfiles = Perfil::all()->lists('nombre','id');
		$hoteles = Hotel::all()->lists('nombre','id');
		$personas = Persona::all()->lists('nombre', 'id');
		return View::make('usuarios.create', compact('perfiles', 'hoteles', 'personas'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /usuarios
	 *
	 * @return Response
	 */
	public function postCreate()
	{
		$input = Input::all();
		$input['password'] = Hash::make($input['password']);
		$usuario = Usuario::create($input);
		return Redirect::to('/usuarios');
	}

	/**
	 * Display the specified resource.
	 * GET /usuarios/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getEdit($id = NULL)
	{
		if (isset($id)) {
			$usuario = Usuario::find($id);
			$perfiles = Perfil::all()->lists('nombre','id');
			$hoteles = Hotel::all()->lists('nombre','id');
			$personas = Persona::all()->lists('nombre', 'id');
			return View::make('usuarios.edit', compact('perfiles', 'hoteles', 'personas', 'usuario'));
		}else{
			return Redirect::to('/usuarios');
		}
	}

	public function getDestroy($id = NULL)
	{
		if (isset($id)) {
			$usuario = Usuario::find($id);
			$usuario->delete();
			return Redirect::back();
		}else{
			return Redirect::back();
		}
	}

}