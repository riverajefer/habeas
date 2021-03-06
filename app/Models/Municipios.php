<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{

     /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table = 'municipios';

     public function ndepartamento(){
         return $this->belongsTo('App\Models\Departamentos', 'departamento');
     }


}
