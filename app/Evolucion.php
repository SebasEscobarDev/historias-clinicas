<?php

namespace GestionClinica;

use Illuminate\Database\Eloquent\Model;

class Evolucion extends Model
{
    //
    protected $table = "evoluciones";

    public function historia(){
    	return $this->belongsTo(Historia::Class);
    }

    public function entidad(){
    	return $this->belongsTo(Entidad::Class);
    }

    public function medicoEspecialista(){
    	return $this->belongsTo(MedicoEspecialista::Class);
    }
}
