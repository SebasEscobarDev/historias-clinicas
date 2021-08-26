<?php

namespace GestionClinica;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    //
    protected $table = 'examenes';

    public function historia(){
    	return $this->hasOne(Historia::class);
    }
}
