<?php

namespace GestionClinica\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GestionClinica\Http\Controllers\Controller;
use Carbon\Carbon;
use GestionClinica\User;
use GestionClinica\MedicoEspecialista;
use GestionClinica\Paciente;
use GestionClinica\Entidad;
use GestionClinica\Antecedente;
use GestionClinica\Historia;

class HistoriaController extends Controller
{

  /*
  TORTA KATA = GUANABANNA O LULO
  */

  //
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('admin', ['only' => 'index']);
    //$this->middleware('admin');
  }

  public function pruebaHistoria()
  {
    //$historias = Historia::where('activo', 1)->get();
    /* prueba historia */
    $historia = Historia::find(1)->first();
    $municipioPaciente = $historia->paciente->municipio;
    //return response()->json(compact(['historia', 'municipioPaciente']));
    return view('historias.index', compact([
                                            'historia',
                                            'municipioPaciente'
                                            ]) );
    /* prueba paciente */
    /*
    $paciente = Paciente::find(2);
    $municipio = $paciente->municipio->nombre;
    $departamento = $paciente->municipio->departamento->nombre;
    return response()->json(compact(['municipio', 'departamento']));
    */
  }

  public function index()
  {
    $medicos = MedicoEspecialista::where('activo', 1)->get();
    $pacientes = Paciente::where('activo', 1)->get();
    $historias = Historia::where('activo', 1)->get();
    $entidades = Entidad::where('activo', 1)->get();
    $medicamentos = DB::table('medicamentos')->get();

    return view('historias.index', compact([
                                            'entidades',
                                            'pacientes',
                                            'historias',
                                            'medicos',
                                            'medicamentos',
                                            ]) );
  }

  //Crear Historia
  public function crear(Request $request){
    if($request->ajax()){

      $responseLog = '';
      $responseErrorLog = '';

      //registrar nueva historia de paciente
      $historia = new Historia;
      $historia->paciente_id = $request->historia['paciente_id'];
      $historia->f_historia = $request->historia['f_historia'];

      $historia->entidad_id = $request->historia['entidad'];
      $historia->medico_especialista_id = $request->historia['profesional_medico'];
      $historia->hora_historia = $request->historia['hora_historia'];
      $historia->acompanante = $request->historia['acompanante'];
      $historia->parentesco = $request->historia['parentesco'];
      $historia->telefono = $request->historia['telefono'];
      $historia->activo = 1;

      if( $historia->save() ){
        $responseLog.='Historia Guardada Correctamente, <br> ';
      }else{
        $responseErrorLog.='No se guardó la historia';
      }
      //Guardar Antecedentes
      $antecedente = new Antecedente;
      $antecedente->historia_id = $historia->id;
      $antecedente->motivo_consulta = $request->antecedentes['motivo_consulta'];
      $antecedente->enfermedad_actual = $request->antecedentes['enfermedad_actual'];
      $antecedente->antecedentes_alergicos = $request->antecedentes['antecedentes_alergicos'];
      $antecedente->antecedentes_personales = $request->antecedentes['antecedentes_personales'];
      $antecedente->antecedentes_familiares = $request->antecedentes['antecedentes_familiares'];
      $antecedente->af_enfermedad_mental = $request->antecedentes['af_enfermedad_mental'];

      if( $antecedente->save() ){
        $responseLog.='Antecedentes Guardados Correctamente, <br> ';
      }else{
        $responseErrorLog.='No se guardó el antecedente';
      }
        
      //Guardar Examen
      $examen = new Examen;
      $examen->historia_id = $historia->id;
      $examen->tension_arterial = $request->examenes['tension_arterial'];
      $examen->fc_lxm = $request->examenes['fc_lxm'];
      $examen->fr_rxm = $request->examenes['fr_rxm'];
      $examen->temperatura = $request->examenes['temperatura'];
      $examen->peso = $request->examenes['peso'];
      $examen->talla = $request->examenes['talla'];
      $examen->imc = $request->examenes['imc'];
      $examen->exploracion_general = $request->examenes['exploracion_general'];
      $examen->otros_resultados = $request->examenes['otros_resultados'];

      if( $examen->save() ){
        $responseLog.='Examenes Guardados Correctamente, <br> ';
      }else{
        $responseErrorLog.='No se guardó el examen';
      }

      $dxtratamiento = new Dxtratamiento;
      $dxtratamiento->historia_id = $historia->id;
      $dxtratamiento->ingreso = $request->dxtratamiento['ingreso'];
      $dxtratamiento->egreso = $request->dxtratamiento['egreso'];
      $dxtratamiento->relacionado_1 = $request->dxtratamiento['relacionado_1'];
      $dxtratamiento->relacionado_2 = $request->dxtratamiento['relacionado_2'];
      $dxtratamiento->impresion_dx = $request->dxtratamiento['impresion_dx'];
      $dxtratamiento->notas_privadas = $request->dxtratamiento['notas_privadas'];
      $dxtratamiento->tratamiento = $request->dxtratamiento['tratamiento'];
      $dxtratamiento->observaciones = $request->dxtratamiento['observaciones'];

      if( $dxtratamiento->save() ){
        $responseLog.='Dxtratamiento Guardado Correctamente, <br> ';
        //$paciente = DB::table('pacientes')->where('id', $request->historia['paciente_id'] )->first();
        //$paciente = Paciente::where('id', $request->historia['paciente_id'] )->first();
        //$historia = DB::table('historias')->where('id', $id_historia )->first();
        $historia = Historia::where([
            ['id', '=', $historia->id],
            ['activo', '=', 1]
          ])->first();
        return response()->json(['yes' => $responseLog,
                                'historia' => $historia,
                                'logError' => $responseErrorLog ]);
      }else{
        $responseErrorLog.='No se guardó dxtratamiento';
        return response()->json(['error' => 'No se pudo registrar la historia']);
      }
      
      
    }
  }

  //continuar la historia
  //Ver historia y complementos
  public function ver(Request $request)
  {
    if( $request->ajax() ){

      $historia = Historia::where([
          ['id', '=', $request->id],
          ['activo', '=', 1]
        ])
        ->with('paciente')
        ->with('entidad')
        ->with('medicoEspecialista')
        ->with('antecedente')
        ->with('examen')
        ->with('dxtratamiento')
        ->with('ordenes')
        ->with('paraclinicos')
        ->with('incapacidades')
        ->with('referencias')
        ->with('evoluciones')
        ->first();

      //activar relaciones dentro de relaciones obtenidas
      /* PACIENTE */
      $historia->paciente->municipio;
      $historia->paciente->departamento;
      $historia->paciente->identificacion;
      /* ENTIDAD */
      //$historia->entidad;
      /* MEDICO ESPECIALISTA */
      //$historia->medicoEspecialista;
      /* ORDENES */
      $historia->ordenes;
      if( isset($historia->ordenes[0]) ){
        $historia->ordenes[0]->medicoEspecialista;
        $historia->ordenes[0]->medicoEspecialista->nombre;
        $historia->ordenes[0]->entidad;
      }
      /* PARACLINICOS */
      $historia->paraclinicos;
      if( isset($historia->paraclinicos[0]) ){
        $historia->paraclinicos[0]->medicoEspecialista;
        $historia->paraclinicos[0]->entidad;
      }
      /* INCAPACIDADES */
      $historia->incapacidades;
      if( isset($historia->incapacidades[0]) ){
        $historia->incapacidades[0]->medicoEspecialista;
        $historia->incapacidades[0]->entidad;
      }

      /* REFERENCIAS */
      $historia->referencias;
      if( isset($historia->referencias[0]) ){
        $historia->referencias[0]->medicoEspecialista;
        $historia->referencias[0]->entidad;
      }
      /* EVOLUCIONES */
      $historia->evoluciones;
      if( isset($historia->evoluciones[0]) ){
        $historia->evoluciones[0]->medicoEspecialista;
        $historia->evoluciones[0]->entidad;
      }

      return response()->json(compact([
        'historia'
      ]));

    }
  }//END VER
  

  //ACTUALIZAR HISTORIA
  public function editar(Request $request)
  {

    if($request->ajax()){

      $historia = Historia::find( $request->historia['historia_id'] );
      $historia->entidad_id = $request->historia['entidad'];
      $historia->medico_especialista_id = $request->historia['profesional_medico'];
      $historia->acompanante = $request->historia['acompanante'];
      $historia->parentesco = $request->historia['parentesco'];
      $historia->telefono = $request->historia['telefono'];

      //actualizar la historia
      if( $historia->save() ){
        return response()->json([
            'yes' => 'Historia Actualizada Correctamente!', 
            'historia' => $historia 
          ]);
      }else{
        return response()->json(['error' => 'No se pudo actualizar la historia']);
      }

    }
  }//END EDITAR


  //Buscador AJAX historias
  function buscar(Request $request)
  {
    if($request->ajax())
    {

      $output = '';
      $query = $request->get('query');
      if($query != ''){
        $data = Historia::where('activo', 1)
        ->where('created_at', 'like', '%'.$query.'%')
        ->orWhere('nombre_1', 'like', '%'.$query.'%')
        ->orWhere('nombre_2', 'like', '%'.$query.'%')
        ->orWhere('apellido_1', 'like', '%'.$query.'%')
        ->orWhere('apellido_2', 'like', '%'.$query.'%')
        ->orWhere('celular', 'like', '%'.$query.'%')
        ->orderBy('id', 'asc')
        ->get();
      }else{
        $data = Historia::orderBy('id', 'asc')
        ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
        foreach($data as $row)
        {

          $active_class = ($row->activo != 1 ) ? ' offline-user' : '';
          $texto_btn = ( $row->activo == 1 ) ? 'Desactivar' : 'Activar';
          $icon = ( $row->activo == 1 ) ? 'clear' : 'check';

          $output .= '
          <tr class="row-id" data-id="'.$row->id.'">
            <td><i class="material-icons">person</i></td>
            <td class="center id">'.$row->id.'</td>
            <td class="center tipo_id">'.$row->tipo_id.'</td>
            <td class="center documento">'.$row->documento.'</td>  
            <td class="center full-name">
              <span class="nombre_1">'.$row->nombre_1.'</span>
              <span class="nombre_2">'.$row->nombre_2.'</span>
              <span class="apellido_1">'.$row->apellido_1.'</span>
              <span class="apellido_2">'.$row->apellido_2.'</span>
            </td>
            <td class="center edad">'.$row->edad.'</td>
            <td class="center sexo">'.$row->sexo.'</td>
            <td class="center celular">'.$row->celular.'</td>
            <td class="center">
              <a class="tooltipped blue darken-4 waves-effect waves-light btn dev-ver-paciente" data-position="top" data-tooltip="Ver" data-view="'.$row->id.'"><i class="material-icons left">remove_red_eye</i></a>
            </td>
            <td class="center">
              <a class="tooltipped blue darken-4 waves-effect waves-light btn dev-edit-paciente" data-position="top" data-tooltip="Editar" data-edit="'.$row->id.'"><i class="material-icons left">edit</i></a>
            </td>
            <td class="center">
              <a class="tooltipped blue darken-4 waves-effect waves-light btn dev-offline-paciente'.$active_class.'" data-position="top" data-tooltip="'.$texto_btn.'" data-active="'.$row->activo.'" data-id="'.$row->id.'"><i class="material-icons left">'.$icon.'</i></a>
            </td>
          </tr>';
        }
      }
      else
      {
        $output = '
        <tr>
        <td align="center" colspan="5">No se encontraron Resultados</td>
        </tr>
        ';
      }
      $data = array(
        'table_data'  => $output,
        'total_data'  => $total_row
      );
      echo json_encode($data);
    }
  }


  //Search In Live Medicamentos
  function buscarMedicamento(Request $request)
  {
    if($request->ajax())
    {
      $output = '';
      $query = $request->get('query');
      if($query != ''){
        $data = DB::table('medicamentos')
        ->where('codigo_cum', 'like', '%'.$query.'%')
        ->orWhere('nombre_far', 'like', '%'.$query.'%')
        ->orderBy('id', 'asc')
        ->get();
      }else{
        $data = DB::table('medicamentos')
        ->orderBy('id', 'asc')
        ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
        foreach($data as $row)
        {
          $output .= '
          <tr class="medicamento-'.$row->id.'">
            <td class="center m-id">'.$row->id.'</td>
            <td class="center m-codigo_cum">'.$row->codigo_cum.'</td>
            <td class="center m-nombre_far">'.$row->nombre_far.'</td>
            <td class="center m-clase_prod">'.$row->clase_prod.'</td>
            <td class="hide m-presentacion">'.$row->presentacion.'</td>
            <td class="center">
              <a href="#!" class="modal-close blue darken-4 waves-effect waves-light btn dev-select-medicamento" data-select="'.$row->id.'">
                <i class="material-icons left text-white">add</i>
              </a>
            </td>
          </tr>
          ';
        }
      }else{
        $output = '
        <tr>
        <td align="center" colspan="5">No se encontraron Resultados</td>
        </tr>
        ';
      }

      $origen = 'buscador-medicamentos';

      $data = array(
        'table_data'  => $output,
        'total_data'  => $total_row,
        'origen'      => $origen
      );
      echo json_encode($data);
    }
  }


  function mostrar_todos_los_medicamentos(){}


}



