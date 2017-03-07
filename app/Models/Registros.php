<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registros extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nombre'
    ];


    public function area(){

        return $this->hasOne('App\Models\Area');

    }


}
