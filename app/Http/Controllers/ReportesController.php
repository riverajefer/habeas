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
        //eturn Registros::whereBetween('created_at', ['2017-03-10 15:46:36', '2017-03-29 14:42:02'])->get();
        return view('reportes.index', compact('registros'));
    }

}
