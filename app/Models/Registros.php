<?php

namespace App\Models;

use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Illuminate\Database\Eloquent\Model;

class Registros extends Model implements AuditableContract
{

     use Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'nombre',
        'primer_apellido',
        'segundo_apellido',
        'tipo_documento',
        'numero_documento',
        'fecha_nacimiento',
        'profesion',
        'cargo',
        'empresa',
        'telefono',
        'email',
        'municipio_id',
        'archivo_soporte',
        'area_id',
        'estado',
        'procedencia',                        
    ];

    public function area(){
        return $this->belongsTo('App\Models\Areas');
    }

    public function municipio(){
        return $this->belongsTo('App\Models\Municipios', 'municipio_id');
    }
    
    public function creadoPor(){
        return $this->belongsTo('App\Models\User', 'creado_por');
    }

    public function modificadoPor(){
        return $this->belongsTo('App\Models\User', 'modificado_por');
    }

    public function tipoRegistro(){
        return $this->belongsTo('App\Models\TipoRegistro', 'tipo_registro');
    }
    
    public function deviceRegistro(){
        return $this->hasOne('App\Models\DeviceRegistro', 'registro_id');
    }


}
