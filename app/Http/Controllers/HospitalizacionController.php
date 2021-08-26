<?php

namespace GestionClinica\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GestionClinica\Http\Controllers\Controller;
use Carbon\Carbon;

class HospitalizacionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => 'index']);
    }

    //Index view
    public function index()
    {
        $pacientes = DB::table('pacientes')->where('activo', 1)->get();

        $historias_pacientes = DB::table('historias')->where('activo', 1)->value('paciente_id');
        $historias = DB::table('historias')->where('activo', 1)->get();
        return view('hospitalizacion.index', 
                        [
                            'pacientes' => $pacientes, 
                            'historias_pacientes' => $historias_pacientes,
                            'historias' => $historias
                        ]);
    }

    //Crear Hospitalizacion - Paciente
    public function crear(Request $request)
    {
        if($request->ajax()){

            //si existe el documento
            /*if ( $doc ){

                return response()->json([
                        'error' => 1,
                        'msg' => "El número de documento :&nbsp;<b>$doc</b>&nbsp; ya se encuentra registrado" ]);

            }else{*/

            /*
            contents[0] = {id: "paciente_id", value: 2}
            contents[1] = {id: "diagnostico_id", value: 1}
            contents[2] = {id: "acompanante", value: "Maria Luisa Cardona"}
            contents[3] = {id: "parentesco", value: "Abuela"}
            contents[4] = {id: "telefono", value: 3104090320}
            contents[5] = {id: "entidad", value: 1}
            */

            //registrar nuevo paciente en hospitalizacion con historia

            $date_time = explode(' ', Carbon::now());
            $date = $date_time[0]; // 2018-02-12
            $time = $date_time[1]; // 02:00

            $id_historia = DB::table('historias')->insertGetId([
                'diagnostico_id' => $request->contents[1]['value'],
                'paciente_id' => $request->contents[0]['value'],
                'f_historia' => Carbon::now(),
                'entidad' => $request->contents[5]['value'],
                'hora_historia' => $time,
                'acompanante' => $request->contents[2]['value'],
                'parentesco' => $request->contents[3]['value'],
                'telefono' => $request->contents[4]['value'],
                'activo' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);

            if( $id_historia > 0 ){
                //id	paciente_id	historia_id	activo	created_at	updated_at
                $hospitalizacion = DB::table('paciente_hospitalizacion')->insert([
                    'paciente_id' => $request->contents[0]['value'],
                    'historia_id' => $id_historia,
                    'activo' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);

                if( $hospitalizacion ){
                    $paciente = DB::table('pacientes')->where('id', $request->contents[0]['value'] )->first();
                    $historia = DB::table('historias')->where('id', $id_historia )->first();
                    return response()->json(['yes' => 'Paciente Ingresado a Hospitalizacion con Historia Médica!',
                                        'paciente' => $paciente,
                                        'historia' => $historia ]);
                }else{
                    return response()->json(['no' => 'No se pudo registrar']);
                }
            }

            //}

        }
    } // END CREAR

    //actualizar Historia
    public function editar(Request $request)
    {

        if($request->ajax()){

            /*
            contents[0] = {id: "paciente_id", value: 2}
            contents[1] = {id: "diagnostico_id", value: 1}
            contents[2] = {id: "acompanante", value: "Maria Luisa Cardona"}
            contents[3] = {id: "parentesco", value: "Abuela"}
            contents[4] = {id: "telefono", value: 3104090320}
            contents[5] = {id: "entidad", value: 1}
            */

            //actualizar

            //'paciente_id' => $request->contents[0]['value'],
            $actualizar = DB::table('historias')->where('id', $request->id)
            ->update([
                'diagnostico_id' => $request->contents[1]['value'],
                'entidad' => $request->contents[5]['value'],
                'acompanante' => $request->contents[2]['value'],
                'parentesco' => $request->contents[3]['value'],
                'telefono' => $request->contents[4]['value'],
                'updated_at' => Carbon::now()
            ]);

            if( $actualizar ){
                $historia = DB::table('historias')->where('id', $request->id )->first();
                $paciente = DB::table('pacientes')->where('id', $historia->paciente_id )->first();
                return response()->json(['yes' => 'Paciente Actualizado Correctamente!',
                                    'paciente' => $paciente,
                                    'historia' => $historia ]);

            }else{
                return response()->json(['no' => 'No se pudo actualizar']);
            }

        }
    }//end editar

    //ver historia {{id}}
    public function ver(Request $request)
    {
        if($request->ajax()){

            $historia =  DB::table('historias')->where('id', $request->id)->first();
            return response()->json(['historia' => $historia]);

        }
    }
}