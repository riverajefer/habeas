<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;


class Finalidades extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table = 'finalidades';


     /**
     * TprimaryKey.
     *
     * @var string
     */
    protected $primaryKey = 'id_fin';     



}
