<?php

namespace GestionClinica\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GestionClinica\Http\Controllers\Controller;
use Carbon\Carbon;

use GestionClinica\Paciente;
use GestionClinica\Identificacion;
use GestionClinica\Municipio;
use GestionClinica\Departamento;

class PacienteController extends Controller
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
    //$registro = $request->session()->get('update');
    $pacientes = Paciente::all();
    $tipo_documento = Identificacion::all();
    $municipios = Municipio::all();
    $departamentos = Departamento::all();

    return view('pacientes.index', [
      'pacientes' => $pacientes,
      'tipo_documento' => $tipo_documento,
      'departamentos' => $departamentos,
      'municipios' => $municipios
    ]);
  }

  //Crear Paciente
  public function crear(Request $request)
  {

    if($request->ajax()){

      $n_doc = $request->paciente['documento'];

      //si existe el documento
      if ( Paciente::where('documento', $n_doc)->exists() ){
        return response()->json([
          'error' => 1,
          'msg' => "El número de documento :&nbsp;<b>$n_doc</b>&nbsp; ya se encuentra registrado" ]
        );

      }else{
        //registrar nuevo
        $paciente               = new Paciente;
        $paciente->identificacion_id = $request->paciente['identificacion_id'];
        $paciente->documento    = $request->paciente['documento'];
        $paciente->nombre_1     = $request->paciente['nombre_1'];
        $paciente->nombre_2     = $request->paciente['nombre_2'];
        $paciente->apellido_1   = $request->paciente['apellido_1'];
        $paciente->apellido_2   = $request->paciente['apellido_2'];
        $paciente->f_nacimiento = $request->paciente['f_nacimiento'];
        $paciente->edad         = $request->paciente['edad'];
        $paciente->rh           = $request->paciente['rh'];
        $paciente->sexo         = $request->paciente['sexo'];
        $paciente->direccion    = $request->paciente['direccion'];
        $paciente->telefono     = $request->paciente['telefono'];
        $paciente->celular      = $request->paciente['celular'];
        $paciente->correo       = $request->paciente['correo'];
        $paciente->clase        = $request->paciente['clase'];
        $paciente->afiliacion   = $request->paciente['afiliacion'];
        $paciente->ocupacion    = $request->paciente['ocupacion'];
        $paciente->municipio_id = $request->paciente['municipio_id'];
        $paciente->departamento_id = $request->paciente['departamento_id'];
        $paciente->activo       = 1;

        if( $paciente->save() ){
          return response()->json(['yes' => 'Paciente Registrado Correctamente!',
                                    'paciente' => $paciente]);
        }else{
          return response()->json(['no' => 'No se pudo registrar']);
        }
      }
    }
  }

  //actualizar Paciente
  public function editar(Request $request)
  {
    if($request->ajax()){

      //actualizar
      $paciente               = Paciente::find($request->id)
                                  ->with('identificacion')
                                  ->first();
      $paciente->identificacion_id = ( (isset($request->paciente['identificacion_id']) ) ? $request->paciente['identificacion_id'] : 0);
      $paciente->documento    = $request->paciente['documento'];
      $paciente->nombre_1     = $request->paciente['nombre_1'];
      $paciente->nombre_2     = $request->paciente['nombre_2'];
      $paciente->apellido_1   = $request->paciente['apellido_1'];
      $paciente->apellido_2   = $request->paciente['apellido_2'];
      $paciente->f_nacimiento = $request->paciente['f_nacimiento'];
      $paciente->edad         = $request->paciente['edad'];
      $paciente->rh           = $request->paciente['rh'];
      $paciente->sexo         = $request->paciente['sexo'];
      $paciente->direccion    = $request->paciente['direccion'];
      $paciente->telefono     = $request->paciente['telefono'];
      $paciente->celular      = $request->paciente['celular'];
      $paciente->correo       = $request->paciente['correo'];
      $paciente->clase        = $request->paciente['clase'];
      $paciente->afiliacion   = $request->paciente['afiliacion'];
      $paciente->ocupacion    = $request->paciente['ocupacion'];
      $paciente->municipio_id = $request->paciente['municipio_id'];
      $paciente->departamento_id = $request->paciente['departamento_id'];

      if( $paciente->save() ){

        return response()->json([
          'yes' => 'Paciente Actualizado Correctamente!',
          'paciente' => $paciente
        ]);
      }else{
          return response()->json(['no' => 'No se pudo actualizar']);
      }

    }
  }

  //ver paciente {{id}}
  public function ver(Request $request)
  {
    if($request->ajax()){

      $paciente = Paciente::find($request->id)
                    ->with('historias')
                    ->with('identificacion')
                    ->with('municipio')
                    ->with('departamento')
                    ->first();


      return response()->json(['paciente' => $paciente]);

    }
  }

  //Metodo para actualizar estado activo // inactivo
  public function active(Request $request)
  {
    if($request->ajax()){
      
      $paciente = Paciente::find( $request->id );
      $paciente->activo = ( $paciente->activo == 0 ) ? 1 : 0;
      if( $paciente->save() ) {
        return response()->json(['activo' => $paciente->activo]);
      }

    }
  }

  //Search In Live Pacientes
  function buscar(Request $request)
  {
    if($request->ajax())
    {
      $output = '';
      $query = $request->get('query');
      if($query != ''){

        $data = Paciente::where('documento', 'like', '%'.$query.'%')
          ->orWhere('nombre_1', 'like', '%'.$query.'%')
          ->orWhere('nombre_2', 'like', '%'.$query.'%')
          ->orWhere('apellido_1', 'like', '%'.$query.'%')
          ->orWhere('apellido_2', 'like', '%'.$query.'%')
          ->orWhere('celular', 'like', '%'.$query.'%')
          ->orderBy('id', 'asc')
          ->with('identificacion')
          ->with('departamento')
          ->with('municipio')
          ->get();
      }else{
        $data = Paciente::all();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
        foreach($data as $row)
        {
          if ( $request->get('vista') == 'paciente' ){

            $active_class = ($row->activo != 1 ) ? ' offline-user' : '';
            $texto_btn = ( $row->activo == 1 ) ? 'Desactivar' : 'Activar';
            $icon = ( $row->activo == 1 ) ? 'clear' : 'check';

            $output .= '
            <tr class="row-id" data-id="'.$row->id.'">
              <td><i class="material-icons">person</i></td>
              <td class="center id">'.$row->id.'</td>
              <td class="center tipo_id">'.$row->identificacion_id.'</td>
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
                <a class="tooltipped blue darken-4 waves-effect waves-light btn dev-ver-paciente" data-position="top" data-tooltip="Ver"><i class="material-icons left">remove_red_eye</i></a>
              </td>
              <td class="center">
                <a class="tooltipped blue darken-4 waves-effect waves-light btn dev-edit-paciente" data-position="top" data-tooltip="Editar"><i class="material-icons left">edit</i></a>
              </td>
              <td class="center">
                <a class="tooltipped blue darken-4 waves-effect waves-light btn dev-offline-paciente'.$active_class.'" data-position="top" data-tooltip="'.$texto_btn.'" data-active="'.$row->activo.'" data-id="'.$row->id.'"><i class="material-icons left">'.$icon.'</i></a>
              </td>
            </tr>';
            //end vista paciente
          }else if( $request->get('vista') == 'historia' ){
            $origen = 'buscador-pacientes';

            $output .= '
            <tr>
              <td class="center">'.$row->id.'</td>
              <td class="center">'.$row->documento.'</td>
              <td class="center">'.$row->nombre_1.' '.$row->nombre_2.' '.$row->apellido_1.' '.$row->apellido_2.'</td>
              <td class="center">'.$row->edad.'</td>
              <td class="center">'.$row->sexo.'</td>
              <td class="center">'.$row->celular.'</td>
              <td class="center">
                <a href="#!" class="modal-close blue darken-4 waves-effect waves-light btn dev-select-paciente" data-select="'.$row->id.'">
                  <i class="material-icons left text-white">add</i>
                </a>
                <div class="position-absolute invisible info-paciente dev-detail-paciente-'.$row->id.'">
                  <div class="col s12 details-paciente">
                    <div class="table-responsive">
                      <table>
                        <tbody>
                          <tr class="tds-details">
                            <td class="hidden"><b>ID:</b><br> <span class="paciente-id">'.$row->id.'</span></td>
                            <td>
                              <b>Nombre 1:</b><br>
                              <span>'.$row->nombre_1.'</span>
                            </td>
                            <td>
                              <b>Nombre 2:</b><br>
                              <span>'.$row->nombre_2.'</span>
                            </td>
                            <td>
                              <b>Apellido 1:</b><br>
                              <span>'.$row->apellido_1.'</span>
                            </td>
                            <td>
                              <b>Apellido 2:</b><br>
                              <span>'.$row->apellido_2.'</span>
                            </td>
                            <td>
                              <b>Tipo de Documento:</b><br>
                              <span>'.$row->identificacion_id.'</span>
                            </td>
                            <td class="td-documento"><b>Documento:</b><br> <span class="doc-paciente">'.$row->documento.'</span></td>
                          </tr>
                          <tr>
                            <td><b>Fecha de Nacimiento:</b><br> '.$row->f_nacimiento.'</td>
                            <td><b>Edad:</b><br> '.$row->edad.'</td>
                            <td><b>Rh:</b><br> '.$row->rh.'</td>
                            <td><b>Sexo:</b><br> '.$row->sexo.'</td>
                            <td><b>Direccion:</b><br> '.$row->direccion.'</td>
                            <td><b>Telefono:</b><br> '.$row->telefono.'</td>
                            <td><b>Celular:</b><br> '.$row->celular.'</td>
                          </tr>
                          <tr>
                            <td><b>Correo:</b><br> '.$row->correo.'</td>
                            <td><b>Clase:</b><br> '.$row->clase.'</td>
                            <td><b>Afiliacion:</b><br> '.$row->afiliacion.'</td>
                            <td><b>Ocupacion:</b><br> '.$row->ocupacion.'</td>
                            <td><b>Departamento:</b><br> '.$row->departamento_id.'</td>
                            <td><b>Municipio:</b><br> '.$row->municipio_id.'</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </td>
            </tr>';
          }
        }
      }else{
        $output = '
        <tr>
        <td align="center" colspan="5">No se encontraron Resultados</td>
        </tr>
        ';
      }

      if ( $request->get('vista') == 'paciente' ){
        $origen = '404';
      }else if( $request->get('vista') == 'historia' ){
        $origen = 'buscador-pacientes';
      }

      $data = array(
        'table_data'  => $output,
        'total_data'  => $total_row,
        'origen'      => $origen
      );
      echo json_encode($data);
    }
  }

}
