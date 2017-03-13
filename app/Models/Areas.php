<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Areas extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected  $fillable = [
           'titulo','responsable','operario', 
     ];

    public function m_responsable(){
        return $this->hasOne('App\User', 'id_user_t4', 'responsable');
    }
    
    public function m_operario(){
        return $this->hasOne('App\User', 'id_user_t4', 'operario');
    }
    


}
