<?php

namespace GestionClinica\Http\Controllers;

use Auth;
use Session;
use Redirect;
use Illuminate\Http\Request;
use Illuminate\Http\Request\LoginRequest;

class IndexController extends Controller
{

    //Index
    public function index()
    {
        if( Auth::check() ){
            return redirect('/medico-especialista');
        }else{
            return view('login');
        }
    }

    public function log(LoginRequest $request){
        if(Auth::attempt(['email'=>$request['email'], 'password'=>$request['password']])){
            return Redirect::to('/medico-especialista');
        }
        Session::flash('message-error','Datos son incorrectos');
        return Redirect::to('/');
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('/');
    }

    public function show(Request $request, $id)
    {
        $value = $request->session()->get('key');
        
        // Retrieve a piece of data from the session...
        $value = session('key');

        // Specifying a default value...
        $value = session('key', 'default');

        // Store a piece of data in the session...
        session(['key' => 'value']);
    }
}
