<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Registros;
use Excel;

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

         $fecha_inicio = $request->input('fecha_inicio');
         $fecha_fin    = $request->input('fecha_fin');
         $registro_id  = $request->input('registro');

         $registro  = Registros::findOrFail($registro_id);
         $auditoria = $registro->audits()->with('user')->whereBetween('created_at', [$fecha_inicio, $fecha_fin])->get();
         
         return view('reportes.resul_auditoria', compact('auditoria', 'fecha_inicio', 'fecha_fin', 'registro_id'));         
         //$registros = Registros::has('audits')->whereBetween('created_at', [$request->input('fecha_inicio'), $request->input('fecha_fin')])->get();
         //$registro  = Registros::findOrFail($id);
         //return $auditoria = $registros->audits()->with('user')->get();
         //return Registros::whereBetween('created_at', [$request->input('fecha_inicio'), $request->input('fecha_fin')])->get();
     }


    /**
     * Auditoria tabla.
     * @param  Request  $registro_id, $fecha_inicio, $fecha_fin
     * @return Response
     */
     public function getHistorialCambiosTabla($registro_id, $fecha_inicio, $fecha_fin){
         
         $registro  = Registros::findOrFail($registro_id);
         $auditoria = $registro->audits()->with('user')->whereBetween('created_at', [$fecha_inicio, $fecha_fin])->get();
         return view('reportes.resul_auditoria_tabla', compact('auditoria', 'fecha_inicio', 'fecha_fin', 'registro_id'));         
     }


    /**
     * Auditoria excel.
     * @param  Request  $registro_id, $fecha_inicio, $fecha_fin
     * @return Response
     */
     public function getHistorialCambiosExcel($registro_id, $fecha_inicio, $fecha_fin){
         
        $excel = \App::make('excel');
        Excel::create('Historial_de_Cambios', function($excel) use ($registro_id, $fecha_inicio, $fecha_fin) {

            $registro  = Registros::findOrFail($registro_id);
            $auditoria = $registro->audits()->with('user')->whereBetween('created_at', [$fecha_inicio, $fecha_fin])->get();

			$excel->sheet('Historial_de_Cambios', function($sheet) use ($auditoria)
	        {
                 $sheet->freezeFirstRow();
                 $sheet->loadView('reportes.resul_auditoria_excel')->with('auditoria', $auditoria);
	        });

		})->download();

     }

}
