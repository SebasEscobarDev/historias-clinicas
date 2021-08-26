<?php

namespace GestionClinica;

use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    //
    public function historia(){
    	return $this->belongsTo(Historia::Class);
    }

    public function entidad(){
    	return $this->belongsTo(Entidad::Class);
    }

    public function MedicoEspecialista(){
    	return $this->belongsTo(MedicoEspecialista::Class);
    }
}
