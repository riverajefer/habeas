<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Datatables;
use App\Models\Areas;

class AreasController extends Controller
{
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

        $areas = Areas::with('m_responsable')->with('m_operario')->select('areas.*');
        //$areas = Areas::query();
        return Datatables::of($areas)
            ->addColumn('action', function ($areas) {
                return '
                    <a class="btn btn-xs btn-link link-warning" href="areas/'.$areas->id.'/edit" data-toggle="tooltip" data-placement="top" title="Modificar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <a class="btn btn-xs btn-link link-danger" data-toggle="tooltip" data-placement="top" title="Dar de baja"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
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
        return view('areas.create');
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
            'responsable'=>'required',
            'operario'=>'required',
        ]);

        $reponsable = $request->input('responsable');
        $operario = $request->input('operario');


        if($reponsable == $operario){
            //return redirect('errorStore')->with('success','Registro creado correctamente');
        }

        $area = new Areas();
        $area->titulo       = $request->input('titulo');
        $area->responsable  = $request->input('responsable');
        $area->operario     = $request->input('operario');
        $area->slug         = str_slug($request->input('titulo'));
        $area->save();

        // preguntar si e operario y el responsable estáa asignados al modulos habes,
        /// Sino están asignarlos  

        return redirect('areas')->with('success','Registro creado correctamente');
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
        $area = Areas::with('m_operario')->with('m_responsable')->get()->find($id);
        if(!$area){
            abort(404);
        }
        return view('areas.edit', compact('area'));
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
        $this->validate($request,[
            'titulo'=>'required|string',
            'responsable'=>'required',
            'operario'=>'required',
        ]);
        Areas::findOrFail($id)->update($request->all());
        return redirect('areas')->with('success','Registro modificado correctamente');
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
