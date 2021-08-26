<?php

namespace GestionClinica;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    public function departamento()
    {
        return $this->belongsTo(Departamento::class);
    }
    
}
