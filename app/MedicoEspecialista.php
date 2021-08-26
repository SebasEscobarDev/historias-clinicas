<?php

namespace GestionClinica;

use Illuminate\Database\Eloquent\Model;

class MedicoEspecialista extends Model
{
    //
    protected $table = "medicos_especialistas";

    public function user(){
    	return $this->hasOne(User::class);
    }

}

