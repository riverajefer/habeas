<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Registros;
use Datatables;
use App\User;

class RegistrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('registros.index');
    }


    /**
    * Process datatables ajax request.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function dataRegistros()
    {
        $registros = Registros::query();
        return Datatables::of($registros)
            ->addColumn('action', function ($registros) {
                return '
                    <a class="btn btn-link link-info"  href="registros/'.$registros->id.'" data-toggle="tooltip" data-placement="top" title="Ver más"><i class="fa fa-eye" aria-hidden="true"></i></a>
                    <a class="btn btn-link link-warning" href="registros/'.$registros->id.'/edit" data-toggle="tooltip" data-placement="top" title="Modificar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <a class="btn btn-link link-danger" data-toggle="tooltip" data-placement="top" title="Dar de baja"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    ';
            })        
            ->editColumn('nombre', '<a href="registros/{{$id}}">{{$nombre}}</a>')
            ->editColumn('id', '{{$id}}')
            ->removeColumn('password')->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('registros.create');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'nombre'=>'required|string',
            'primer_apellido'=>'required|string',
            'segundo_apellido'=>'required|string',
            'tipo_documento'=>'required|string',
            'numero_docuemnto'=>'required|string',
            'email'=>'required|email',
            'fecha_nacimiento'=>'required|date',
        ]);
        return $request;
    }

   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $registro = Registros::findOrFail($id);
        return view('registros.show', compact('registro'));
    }

  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('registros.edit');
        return "Edit: ".$id;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
