<?php

namespace GestionClinica\Http\Middleware;
use Illuminate\Contracts\Auth\Guard;
use Closure;
use Session;

class Admin
{

    protected $auth;
    public function __construct(Guard $auth){
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        /*if( $request->activo <= 0 ){
            return redirect('/');
        }*/

        if( $this->auth->user()->id != 1 ){
            Session::flash('message-error', 'Sin privilegios');
            return redirect()->to('/');
        }

        return $next($request);
    }

}
