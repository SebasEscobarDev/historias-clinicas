<?php

namespace GestionClinica;

use Illuminate\Database\Eloquent\Model;

class Incapacidad extends Model
{
    //
    protected $table = "incapacidades";

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
