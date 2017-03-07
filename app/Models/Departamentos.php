<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{

     /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table = 'departamentos';


     public function municipios()
     {
         return $this->hasMany('App\Models\Municipios', 'departamento');
     }

}
