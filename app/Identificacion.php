<?php

namespace GestionClinica;

use Illuminate\Database\Eloquent\Model;

class Identificacion extends Model
{
    //

    protected $table = "identificaciones";

    public function historia(){
    	return $this->hasMany(Historia::class);
    }
}
