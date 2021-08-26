<?php

namespace GestionClinica\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GestionClinica\Http\Controllers\Controller;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

use GestionClinica\Incapacidad;

class HistoriaIncapacidadesController extends Controller
{
  //HISTORIA-INCAPACIDADES CREAR
  public function crear(Request $request)
  {
    if( $request->ajax() ){
      
      /*
      $id_incapacidad = DB::table('historia_incapacidades')->insertGetId([
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);
      */
      $incapacidad = new Incapacidad;
      $incapacidad->historia_id       = $request->incapacidad['historia_id'];
      $incapacidad->td                = $request->incapacidad['td'];
      $incapacidad->incapacidad       = $request->incapacidad['incapacidad'];
      $incapacidad->fecha             = $request->incapacidad['fecha'];
      $incapacidad->hora              = $request->incapacidad['hora'];
      $incapacidad->entidad           = $request->incapacidad['entidad'];
      $incapacidad->profesional_medico= $request->incapacidad['profesional_medico'];
      $incapacidad->clase_incapacidad = $request->incapacidad['clase_incapacidad'];
      $incapacidad->tipo_incapacidad  = $request->incapacidad['tipo_incapacidad'];
      $incapacidad->dias              = $request->incapacidad['dias'];
      $incapacidad->inicio            = $request->incapacidad['inicio'];
      $incapacidad->finalizacion      = $request->incapacidad['finalizacion'];
      $incapacidad->txt_dias          = $request->incapacidad['txt_dias'];
      $incapacidad->diagnostico       = $request->incapacidad['diagnostico'];
      $incapacidad->descripcion       = $request->incapacidad['descripcion'];


      if( $incapacidad->save() ){
        /* activar relaciones de consulta */
        $incapacidad->historia;
        $incapacidad->historia->paciente;
        $incapacidad->entidad;
        $incapacidad->medicoEspecialista;

        return response()->json([
          'yes' => 'Nueva Incapacidad incapacidad Agregado Exitosamente!',
          'incapacidad' => $incapacidad
        ]);
      }else{
        return response()->json([
          'error' => 'No se pudo agregar la nueva Incapacidad!'
        ]);
      }

    }
  }

  //PDF ORDEN
  public function pdf($incapacidad_id)
  {
    $incapacidad = Incapacidad::where('id', $incapacidad_id)
                    ->with('historia')
                    ->with('entidad')
                    ->with('medicoEspecialista')
                    ->first();
    $incapacidad->historia->paciente;

    $pdf = PDF::loadView('historias.pdf.incapacidad', compact(['incapacidad']) );
    return $pdf->stream('incapacidad.pdf');
    //return PDF::loadFile(public_path().'/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');
  }

}
