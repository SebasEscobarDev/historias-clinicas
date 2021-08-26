<?php

namespace GestionClinica;

use Illuminate\Database\Eloquent\Model;

class Historia extends Model
{

	/*


	digo que en la tabla comentarios hay una columna con el nombre post_id que pueden ser muchos 

	public function comments()
    {
        return $this->hasMany('App\Comment');
    }


    digo que phone tiene una foreign key = user_id

    public function phone()
    {
        return $this->hasOne('App\Phone');
    }


    digo que phone tiene la foreign key de user 

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    */

	/* pertenece a un paciente */
	public function paciente(){
		return $this->belongsTo(Paciente::class);
		//return $this->hasOne(Paciente::class);
	}

	/* tiene una entidad */
	public function entidad(){
		return $this->belongsTo(Entidad::class);
	}

	/* tiene un medico especialista */
	public function medicoEspecialista(){
		return $this->belongsTo(MedicoEspecialista::class);
	}

	/* tiene antecedentes [uno a uno] */
	public function antecedente(){
		return $this->hasOne(Antecedente::class);
	}

	/* tiene examenes [uno a uno] */
	public function examen(){
		return $this->hasOne(Examen::class);
	}

	/* tiene un dxtratamiento [uno a uno] */
	public function dxtratamiento(){
		return $this->hasOne(Dxtratamiento::class);
	}

	/* tiene muchas ordenes */
	public function ordenes(){
		return $this->hasMany(Orden::class);
	}

	/* tiene muchas ordenes de paraclinicos */
	public function paraclinicos(){
		return $this->hasMany(Paraclinico::class);
	}

	/* tiene muchas ordenes de incapacidades */
	public function incapacidades(){
		return $this->hasMany(Incapacidad::class);
	}

	/* tiene muchas ordenes de referencias */
	public function referencias(){
		return $this->hasMany(Referencia::class);
	}

	/* tiene muchas ordenes de evoluciones */
	public function evoluciones(){
		return $this->hasMany(Evolucion::class);
	}

}
