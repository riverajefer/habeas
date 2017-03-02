<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Datatables;

use Dompdf\Dompdf;
use Excel;



class DatatablesController extends Controller
{

    /**
    * Displays datatables front end view
    *
    * @return \Illuminate\View\View
    */
    public function getIndex()
    {
        return view('datatables.index');
    }

    /**
    * Process datatables ajax request.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function anyData()
    {
        return Datatables::of(User::query())->make(true);
    }












    public function pdf(){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }

    public function excel(){
        $excel = \App::make('excel');


        Excel::create('Filename', function($excel) {

            $excel->sheet('Sheetname', function($sheet) {

                // Sheet manipulation

            });

        })->export('xls');

    }



}
