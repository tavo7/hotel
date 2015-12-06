<?php

class ReportesController extends \BaseController {

	public function getIndex()
	{
		return View::make('reportes.index');
	}

    public function getListarReportes(){
        $fecha = Input::get('fecha');
        if(!isset($fecha)){
            return Redirect::back();
        }
        return View::make('reportes.listar', compact('fecha'));
    }

    public function getVentas(){
        $fecha = Input::get('fecha');
        $detallescaja = Detallecaja::whereBetween('fechainicio',[$fecha.' 00:00:00',$fecha.' 23:59:59'])
                        ->with(['ventas','ventas.alquiler','ventas.alquiler.habitacion','ventas.productos', 'usuario'])
                        ->get();
        return Response::json($detallescaja);
        //return View::make('reportes.ventas', compact('detallescaja'));
    }

}