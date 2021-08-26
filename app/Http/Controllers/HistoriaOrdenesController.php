<?php

namespace GestionClinica\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GestionClinica\Http\Controllers\Controller;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use GestionClinica\Orden;

class HistoriaOrdenesController extends Controller
{
  //HISTORIA-ORDENES CREAR
  public function crear(Request $request)
  {
    if( $request->ajax() ){
      
      $orden = new Orden;
      $orden->historia_id = $request->orden['historia_id'];
      $orden->td = $request->orden['td'];
      $orden->formula = $request->orden['formula'];
      $orden->fecha = $request->orden['fecha'];
      $orden->entidad_id = $request->orden['entidad_id'];
      $orden->medico_especialista_id = $request->orden['medico_especialista_id'];
      $orden->ac_alergicos = $request->orden['ac_alergicos'];
      $orden->medicamentos = json_encode($request->medicamentos);

      if( $orden->save() ){
        $fecha_formula = '';
        $medicamentos = '';
        $content_formula = '';

        $fecha_formula .= '
          <tr class="row ver-formula-paciente" data-orden="'.$orden->id.'" style="margin-bottom: 0px;">
            <td class="col-md-4" style="padding-left:36px; padding-bottom:7px;padding-top:7px;">'.$orden->formula.'</td>
            <td class="col-md-8 text-center" style="padding-left:0px; padding-bottom:7px;padding-top:7px;">'.$orden->fecha.'</td>
          </tr>
        ';

        $array_medicamentos = json_encode($request->medicamentos);
        $array_medicamentos = json_decode($array_medicamentos);
        foreach ($array_medicamentos as $medicamento ) {
          $medicamentos .= '<tr class="ver-medicamento" style="margin-bottom: 0px;">
            <td>'.$medicamento->codigo_cum.'</td>
            <td>'.$medicamento->nombre_far.'</td>
            <td>'.$medicamento->presentacion.'</td>
            <td>'.$medicamento->cantidad.'</td>
            <td>'.$medicamento->dosis.'</td>
            <td>'.$medicamento->dias.'</td>
          </tr>';        
        }

        $content_formula .= '
          <tr data-detalle-orden="'.$orden->id.'" style="margin-bottom: 0px;">
            <td class="col-md-12">
              <table>
                <tr>
                  <th colspan="6" class="text-center blue darken-2 text-white" style="padding:0px">
                    <h5 style="padding-top:7px;">Entidad: '.$orden->entidad->nombre_entidad.'</h5>
                  </th>
                </tr>
                <tr>
                  <td><b>Formula:</b><br>'.$orden->formula.'</td>
                  <td><b>Fecha:</b><br>'.$orden->fecha.'</td>
                  <td><b>Profesional Médico:</b><br>'.$orden->medicoEspecialista->nombre.'</td>
                  <td colspan="2"><b>Antecedentes Alergicos:</b> <br>'.$orden->ac_alergicos.'</td>
                </tr>
                <tr>
                  <th colspan="6" class="text-center blue darken-2 text-white" style="padding:0px">
                    <h5 style="padding-top:1px;margin-bottom:3px;">Medicamentos</h5>
                  </th>
                </tr>
                <tr>
                  <th>Código Cum</th>
                  <th>Nombre</th>
                  <th>Presentación</th>
                  <th>Cantidad</th>
                  <th>Dosis</th>
                  <th>Días / Meses</th>
                </tr>
                '.$medicamentos.'
                <tr>
                  <!-- Archivo Descargable -->
                  <td colspan="6" style="padding-bottom:0px;padding-top:0px;">
                    <div class="row" style="margin-bottom: 0px;">
                      <div class="col-md-12 text-center">
                        <a href="http://'.$_SERVER['HTTP_HOST'].'/descargar-orden/'.$orden->id.'" class="waves-effect waves-light btn blue darken-4 ver-documento" target="_blank">
                          <i class="material-icons small">insert_drive_file</i>&nbsp;<span>Ver Orden</span>
                        </a>
                        <!-- href="http://'.$_SERVER['HTTP_HOST'].'/editar-orden/'.$orden->id.'" -->
                        <a href="#editar-orden" class="waves-effect waves-light btn blue darken-4 ver-documento" target="_blank">
                          <i class="material-icons small">insert_drive_file</i>&nbsp;<span>Editar Orden</span>
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>';

        return response()->json([
          'yes' => 'Nueva Formula Agregada Exitosamente!',
          'id_orden' => $orden->id,
          'formula' => $request->orden['formula'],
          'fecha_formula' => $fecha_formula,
          'content_formula' => $content_formula
        ]);
      }else{
        return response()->json([
          'error' => 'No se pudo agregar la nueva Formula!'
        ]);
      }

    }
  }

  public function editar($paciente_id, $historia_id, $orden_id){
    return 0;
  }

  //PDF ORDEN
  public function pdf($orden_id)
  {
    //historia, entidad, medico
    $orden = Orden::find($orden_id);
                    ->with('historia')
                    ->with('entidad')
                    ->with('medicoEspecialista')
                    ->first();
    $orden->historia->paciente;

    $pdf = PDF::loadView('historias.pdf.orden', compact([ 'orden' ]) );
    return $pdf->stream('orden.pdf');
    //return PDF::loadFile(public_path().'/myfile.html')->save('/path-to/my_stored_file.pdf')->stream('download.pdf');
  }
  
}
