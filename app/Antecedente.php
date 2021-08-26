<?php

namespace GestionClinica;

use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model
{
    //
    public function historia(){
    	return $this->hasOne(Historia::class);
    }
}
