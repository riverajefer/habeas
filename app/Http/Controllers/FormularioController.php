<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Registros;
use App\Models\Areas;
use App\Models\Departamentos;
use App\Models\Municipios;
use App\Models\User;


class FormularioController extends Controller
{

    /**
     * Store a new user.
     * @param  String  $slug
     * @return \Illuminate\View\View
     */
     public function formulario($slug='publico'){

        $area = Areas::whereSlug($slug)->first();
        
        if(!empty($area)){
            $departamentos = Departamentos::all();
            return view('formularios_publico.index', compact('departamentos', 'area'));
        }else{
            abort(404);
        }

     }

}
