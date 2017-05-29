<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Datatables;
use Auth;
use App\Models\Areas;
use App\Models\User;
use App\Models\AreasUsers;
use App\Models\ModulosUsers;


class AreasController extends Controller
{


    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('role:areas');  
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return $areas = Areas::orderBy('id', 'DESC')->paginate(10);       
        return view('areas.index');
    }

    /**
    * Process datatables ajax request.
    *
    * @return \Illuminate\Http\JsonResponse
    */
    public function dataAreas()
    {

        $areas = Areas::all();
        //$areas = Areas::query();
        return Datatables::of($areas)
            ->addColumn('action', function ($areas) {
                return '
                    <a class="btn btn-xs btn-link link-warning" href="areas/'.$areas->id.'/edit" data-toggle="tooltip" data-placement="top" title="Modificar"> Ver-Modificar <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    ';
            })        
            ->editColumn('titulo', '{{$titulo}}')
            ->editColumn('slug', '<a href="{{URL::to("formulario/".$slug)}}" target="_blank">Ver formulario</a>')->make(true);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $usuarios = User::role(['responsable', 'operario'])->get();
        return view('areas.create', compact('usuarios'));
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
            'titulo'=>'required|string',
            'usuarios'=>'required',
        ]);

        $usuarios  = $request->input('usuarios');

        $area = new Areas();
        $area->titulo  = $request->input('titulo');
        $area->slug    = str_slug($request->input('titulo'));
        $area->save();
        $area->users()->attach($usuarios);

        return redirect('areas')->with('success','Área creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $area = Areas::findOrFail($id);
        $usuarios_s = $area->users;
        $usuarios   = User::role(['responsable', 'operario'])->get();
        return view('areas.edit', compact('area', 'usuarios', 'usuarios_s'));
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
        $area = Areas::findOrFail($id);
        $this->validate($request,[
            'titulo'=>'required|string',
            'usuarios'=>'required',
        ]);

        $usuarios  = $request->input('usuarios');

        $area->titulo  = $request->input('titulo');
        $area->save();
        $area->users()->sync($usuarios);

        return redirect('areas')->with('success','Área modificada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // cuando se elimine un área, eliminar los registros asociados 
    }

    
}

