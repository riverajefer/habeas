<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulos extends Model
{
     /**
     * TprimaryKey.
     *
     * @var string
     */
    protected $primaryKey = 'idmodfunc_t20';    
    protected $table = 'modfunc_t20';


    public function users(){
        return $this->belongsToMany('App\User','perfusr_t21', 'idmodfunc_t21', 'idusr_t21');
    }
}
