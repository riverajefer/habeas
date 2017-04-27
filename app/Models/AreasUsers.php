<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

class AreasUsers extends Model implements AuditableContract
{

     /**
     * The table associated with the model.
     *
     * @var string
     */
     protected $table = 'areas_users';

}
