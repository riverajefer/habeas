<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;


class Areas extends Model implements AuditableContract
{
    use Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected  $fillable = [
           'titulo','responsable','operario', 
     ];

    public function m_responsable(){
        return $this->hasOne('App\Models\User', 'id_user_t4', 'responsable');
    }
    
    public function m_operario(){
        return $this->hasOne('App\Models\User', 'id_user_t4', 'operario');
    }

    public function registros(){
        return $this->hasMany('App\Models\Registros', 'area_id');
    }

/*
    public function responsable(){
        return $this->belongsTo('')
    }
  */  


}
