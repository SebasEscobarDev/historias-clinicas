<?php

namespace GestionClinica\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GestionClinica\Http\Controllers\Controller;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

use GestionClinica\Historia;
use GestionClinica\Evolucion;

class HistoriaEvolucionesController extends Controller
{
  //HISTORIA-REFERENCIAS CREAR
  public function crear(Request $request)
  {
    if( $request->ajax() ){
      
      $evolucion = new Evolucion;
      $evolucion->historia_id           = $request->evolucion['historia_id'];
      $evolucion->td                    = $request->evolucion['td'];
      $evolucion->control               = $request->evolucion['control'];
      $evolucion->fecha                 = $request->evolucion['fecha'];
      $evolucion->hora                  = $request->evolucion['hora'];
      $evolucion->entidad_id            = $request->evolucion['entidad'];
      $evolucion->medico_especialista_id= $request->evolucion['profesional_medico'];
      $evolucion->subjetivo             = $request->evolucion['subjetivo'];
      $evolucion->objetivo              = $request->evolucion['objetivo'];
      $evolucion->descripcion           = $request->evolucion['descripcion'];
      $evolucion->observaciones         = $request->evolucion['observaciones'];
      $evolucion->intervencion          = $request->evolucion['intervencion'];

      if( $evolucion->save() ){

        /* activar relaciones de consulta */
        $evolucion->historia;
        $evolucion->historia->paciente;
        $evolucion->entidad;
        $evolucion->medicoEspecialista;

        return response()->json([
          'yes' => 'Nueva Evolucion Agregada Exitosamente!',
          'evolucion' => $evolucion
        ]);
      }else{
        return response()->json([
          'error' => 'No se pudo agregar la nueva Evolucion!'
        ]);
      }

    }
  }


  //PDF ORDEN
  public function pdf($evolucion_id)
  {
    $evolucion = Evolucion::where('id', $evolucion_id)
                    ->with('historia')
                    ->with('entidad')
                    ->with('medicoEspecialista')
                    ->first();
    $evolucion->historia->paciente;

    $pdf = PDF::loadView('historias.pdf.evolucion', compact(['evolucion']) );
    return $pdf->stream('evolucion.pdf');
    //return PDF::loadFile(public_path().'/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');
  }


}
