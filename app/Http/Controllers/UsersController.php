<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Registros;
use Datatables;
use App\Models\Areas;
use App\Models\User;
use App\Models\Modulos;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }


    /**
     * Retorna los usuarios que estàn en el módulo de habeas
     *
     * @return \Illuminate\Http\Response
     */
    public function habeas()
    {
        $modulos = Modulos::find(21);
        return $modulos->users()->get();
    }

}