<?php

namespace GestionClinica;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{

    public function historias()
    {
        return $this->hasMany(Historia::class);
    }
    
    public function identificacion()
    {
        return $this->belongsTo(Identificacion::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
    

}
