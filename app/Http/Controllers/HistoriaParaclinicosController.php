<?php

namespace GestionClinica\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GestionClinica\Http\Controllers\Controller;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

use GestionClinica\Paraclinico;

class HistoriaParaclinicosController extends Controller
{

	//HISTORIA-PARACLINICOS CREAR
  public function crear(Request $request)
  {
    if( $request->ajax() ){

      $paraclinico = new Paraclinico;

      $paraclinico->historia_id            = $request->paraclinico['historia_id'];
      $paraclinico->td                     = $request->paraclinico['td'];
      $paraclinico->solicitud              = $request->paraclinico['solicitud'];
      $paraclinico->fecha                  = $request->paraclinico['fecha'];
      $paraclinico->entidad_id             = $request->paraclinico['entidad'];
      $paraclinico->medico_especialista_id = $request->paraclinico['profesional_medico'];
      $paraclinico->diagnosticos           = $request->paraclinico['diagnosticos'];

      if( $paraclinico->save() ){
        /* activar relaciones de consulta */
        $paraclinico->historia;
        $paraclinico->historia->paciente;
        $paraclinico->entidad;
        $paraclinico->medicoEspecialista;
        return response()->json([
          'yes' => 'Nueva Formula Paraclinico Agregado Exitosamente!',
          'paraclinico' => $paraclinico,
          'id_paciente' => $request->paciente
        ]);
      }else{
        return response()->json([
          'error' => 'No se pudo agregar la nueva Formula!'
        ]);
      }

    }
  }

  //PDF ORDEN
  public function pdf($paciente_id, $historia_id, $paraclinico_id)
  {
    $paraclinico = Paraclinico::find($paraclinico_id)
                    ->with('historia')
                    ->with('entidad')
                    ->with('medicoEspecialista')
                    ->first();
    $paraclinico->historia->paciente;

    $pdf = PDF::loadView('historias.pdf.paraclinico', compact([ 'paraclinico' ]) );
    return $pdf->stream('paraclinico.pdf');
    //return PDF::loadFile(public_path().'/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');
  }


}
