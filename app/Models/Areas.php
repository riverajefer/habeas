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
           'titulo','user_id'
     ];

    public function user(){
        return $this->hasOne('App\User', 'id_user_t4', 'user_id');
    }

}
