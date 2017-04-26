<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModulosUsers extends Model
{

     /**
     * TprimaryKey.
     *
     * @var string
     */
    protected $primaryKey = 'idperfusr_t21';    
    protected $table = 'perfusr_t21';

    public function users(){
        return $this->belongsTo('App\Models\User', 'idusr_t21');
    }


}
