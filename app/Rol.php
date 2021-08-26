<?php

namespace GestionClinica;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    //
    protected $table = "roles";
    
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
