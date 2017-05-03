<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Registros;
use App\Models\Areas;
use Excel;
use Carbon\Carbon;


class ReportesController extends Controller
{

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:reportes');  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $registros = Registros::has('audits')->get(['id', 'nombre', 'empresa']);
        $areas = Areas::all();
        return view('reportes.index', compact('registros', 'areas'));
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
        $area_id      = $request->input('area');

        $date1 = str_replace('-', '/', $fecha_inicio);
        $fecha_inicio_c = date('Y-m-d',strtotime($date1 . "-1 days"));
        $date2 = str_replace('-', '/', $fecha_fin);
        $fecha_fin_c = date('Y-m-d',strtotime($date2 . "+1 days"));

         if($registro_id==0){
              $auditoria = collect();
              $area = Areas::find($area_id);
              $registros = $area->registros;
              foreach($registros as $registro){
                  $auditoria = $auditoria->merge($registro->audits()->with('user')->whereBetween('created_at', [$fecha_inicio_c, $fecha_fin_c])->get());
              }
         }else{
            $registro  = Registros::findOrFail($registro_id);
            $auditoria = $registro->audits()->with('user')->whereBetween('created_at', [$fecha_inicio_c, $fecha_fin_c])->get();
         }
         
         return view('reportes.resul_auditoria', compact('auditoria', 'fecha_inicio', 'fecha_fin', 'registro_id', 'area_id'));         
     }


    /**
     * Auditoria tabla.
     * @param  Request  $registro_id, $fecha_inicio, $fecha_fin
     * @return Response
     */
     public function getHistorialCambiosTabla($area_id, $registro_id, $fecha_inicio, $fecha_fin){

        $date1 = str_replace('-', '/', $fecha_inicio);
        $fecha_inicio_c = date('Y-m-d',strtotime($date1 . "-1 days"));
        $date2 = str_replace('-', '/', $fecha_fin);
        $fecha_fin_c = date('Y-m-d',strtotime($date2 . "+1 days"));

         if($registro_id==0){
              $auditoria = collect();
              $area = Areas::find($area_id);
              $registros = $area->registros;
              foreach($registros as $registro){
                  $auditoria = $auditoria->merge($registro->audits()->with('user')->whereBetween('created_at', [$fecha_inicio_c, $fecha_fin_c])->get());
              }
         }else{
            $registro  = Registros::findOrFail($registro_id);
            $auditoria = $registro->audits()->with('user')->whereBetween('created_at', [$fecha_inicio_c, $fecha_fin_c])->get();
         }
                
         return view('reportes.resul_auditoria_tabla', compact('auditoria', 'fecha_inicio', 'fecha_fin', 'registro_id', 'area_id'));
     }


    /**
     * Auditoria excel.
     * @param  Request  $registro_id, $fecha_inicio, $fecha_fin
     * @return Response
     */
     public function getHistorialCambiosExcel($area_id, $registro_id, $fecha_inicio, $fecha_fin){
         
        $excel = \App::make('excel');
        Excel::create('Historial_de_Cambios', function($excel) use ($registro_id, $fecha_inicio, $fecha_fin, $area_id) {

            $date1 = str_replace('-', '/', $fecha_inicio);
            $fecha_inicio_c = date('Y-m-d',strtotime($date1 . "-1 days"));
            $date2 = str_replace('-', '/', $fecha_fin);
            $fecha_fin_c = date('Y-m-d',strtotime($date2 . "+1 days"));

            if($registro_id==0){
                $auditoria = collect();
                $area = Areas::find($area_id);
                $registros = $area->registros;
                foreach($registros as $registro){
                    $auditoria = $auditoria->merge($registro->audits()->with('user')->whereBetween('created_at', [$fecha_inicio_c, $fecha_fin_c])->get());
                }
            }else{
                $registro  = Registros::findOrFail($registro_id);
                $auditoria = $registro->audits()->with('user')->whereBetween('created_at', [$fecha_inicio_c, $fecha_fin_c])->get();
            }

			$excel->sheet('Historial_de_Cambios', function($sheet) use ($auditoria)
	        {
                 $sheet->freezeFirstRow();
                 $sheet->loadView('reportes.resul_auditoria_excel')->with('auditoria', $auditoria);
	        });

		})->download();

     }

}
