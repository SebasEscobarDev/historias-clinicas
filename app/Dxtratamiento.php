<?php

namespace GestionClinica;

use Illuminate\Database\Eloquent\Model;

class Dxtratamiento extends Model
{
    //
    protected $table = "dxtratamiento";

    public function historia(){
    	return $this->hasOne(Historia::class);
    }
}
