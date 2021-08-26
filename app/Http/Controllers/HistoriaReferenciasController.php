<?php

namespace GestionClinica\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GestionClinica\Http\Controllers\Controller;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class HistoriaReferenciasController extends Controller
{
  //
  //BBDD
	//	id	historia_id	td	remision	fecha	hora	entidad	profesional_medico	especialidad	diagnostico	enfermedad_actual	contra	hallazgos	examenes	tratamiento	created_at	updated_at

  //HISTORIA-REFERENCIAS CREAR
  public function crear(Request $request)
  {
    if( $request->ajax() ){
      
      $id_referencia = DB::table('historia_referencia')->insertGetId([
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
      ]);

      $referencia = new Referencia;
      $referencia->historia_id = $request->referencia['historia_id'];
      $referencia->td = $request->referencia['td'];
      $referencia->remision = $request->referencia['remision'];
      $referencia->fecha = $request->referencia['fecha'];
      $referencia->hora = $request->referencia['hora'];
      $referencia->entidad = $request->referencia['entidad'];
      $referencia->profesional_medico = $request->referencia['profesional_medico'];
      $referencia->especialidad = $request->referencia['especialidad'];
      $referencia->diagnostico = $request->referencia['diagnostico'];
      $referencia->enfermedad_actual = $request->referencia['enfermedad_actual'];
      $referencia->contra = $request->referencia['contra'];
      $referencia->hallazgos = $request->referencia['hallazgos'];
      $referencia->examenes = $request->referencia['examenes'];
      $referencia->tratamiento = $request->referencia['tratamiento'];

      if( $referencia->save() ){
        /* activar relaciones de consulta */
        $referencia->historia;
        $referencia->historia->paciente;
        $referencia->entidad;
        $referencia->medicoEspecialista;
        return response()->json([
          'yes' => 'Nueva Referencia Agregado Exitosamente!',
          'referencia' => $referencia
        ]);
      }else{
        return response()->json([
          'error' => 'No se pudo agregar la nueva Referencia!'
        ]);
      }

    }
  }


  //PDF ORDEN
  public function pdf($paciente_id, $historia_id, $referencia_id)
  {
    $referencia = Referencia::find($referencia_id)
                    ->with('historia')
                    ->with('entidad')
                    ->with('medicoEspecialista')
                    ->first();

    $referencia->historia->paciente;

    $pdf = PDF::loadView('historias.pdf.referencia', compact([ 'referencia' ]) );
    return $pdf->stream('referencia.pdf');
    //return PDF::loadFile(public_path().'/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');
  }


}
