<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Registros;


class ReportesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        //return Registros::find(2);
        //return $registros = ;
        $registros = Registros::has('audits')->get(['id', 'nombre', 'empresa']);
        //return Registros::whereBetween('created_at', ['2017-03-10 15:46:36', '2017-03-29 14:42:02'])->get();
        return view('reportes.index', compact('registros'));
    }


    /**
     * consulta historial.
     * @param  Request  $request
     * @return Response
     */
     public function getHistorialCambios(Request $request){
         //return $request->all();
         return $registros = Registros::has('audits')->whereBetween('created_at', [$request->input('fecha_inicio'), $request->input('fecha_fin')])->get();
         //return Registros::whereBetween('created_at', [$request->input('fecha_inicio'), $request->input('fecha_fin')])->get();
     }


}
