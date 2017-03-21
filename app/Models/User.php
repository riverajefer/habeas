<?php

namespace App\Models;

use Eloquence, Mappable, Mutable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{


     /**
     * TprimaryKey.
     *
     * @var string
     */
    protected $primaryKey = 'id_user_t4';

     /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table = 'users_t4';


    protected $mappedOnly = true;
    protected $map = [
        'id_user_t4' => 'id',
        'email_t4' => 'email',
        'nom_user_t4' =>'nombre',
        'estado_t4' =>'estado',
    ];


    protected $appends = [
        'id', 'nombre', 'email', 'estado'
    ];

    public function getidAttribute()
    {
        return $this->attributes['id_user_t4'];
    }   

    public function getnombreAttribute()
    {
        return $this->attributes['nom_user_t4'];
    }  

    public function getemailAttribute()
    {
        return $this->attributes['email_t4'];
    }
      

    public function getestadoAttribute()
    {
        return $this->attributes['estado_t4'];
    }   


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'created_by', 
        'updated_by', 
        'modiniruta_t4', 
        'created_at', 
        'updated_at',
        'estado_t4',
        'nom_user_t4',
        'email_t4',
        'ref1_t4',
        'id_user_t4'
    ];


  public function setAttribute($key, $value)
  {
    $isRememberTokenAttribute = $key == $this->getRememberTokenName();
    if (!$isRememberTokenAttribute)
    {
      parent::setAttribute($key, $value);
    }
  }


    /**
     * Los modulos que pertenecen al usuario.
     */
    public function modulos()
    {
        return $this->belongsToMany('App\Models\Modulos', 'perfusr_t21', 'idusr_t21', 'idmodfunc_t21');
    }

    public function areasResponsable(){
        return $this->hasMany('App\Models\Areas', 'responsable');
    }

    public function areasOperario(){
        return $this->hasMany('App\Models\Areas', 'operario');
    }

}
