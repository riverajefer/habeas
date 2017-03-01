<?php

namespace App;

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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom_user_t4', 'email_t4', 'password', 'id_perf_t4'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];


  public function setAttribute($key, $value)
  {
    $isRememberTokenAttribute = $key == $this->getRememberTokenName();
    if (!$isRememberTokenAttribute)
    {
      parent::setAttribute($key, $value);
    }
  }

}
