<?php

namespace GestionClinica\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GestionClinica\Http\Controllers\Controller;
use Carbon\Carbon;
use GestionClinica\MedicoEspecialista;
use GestionClinica\User;

class MedicoEspecialistaController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('admin', ['only' => 'index']);
  }

  //Index view
  public function index()
  {
    //$medicos = DB::table('medicos_especialistas')->get();
    $medicos = MedicoEspecialista::all();
    return view('medico_especialista.index', ['medicos' => $medicos]);
  }

  //Metodo para actualizar estado activo // inactivo
  public function active(Request $request)
  {
    if($request->ajax()){
      $medico = MedicoEspecialista::find( $request->id );
      $medico->activo = ($medico->activo == 0) ? 1 : 0;
      if( $medico->save() ) {
          return response()->json(['activo' => $medico->activo]);
      }
    }
  }

  //Crear Medico-Especialista
  public function crear(Request $request)
  {

    if($request->ajax()){

      if( $request->medico['nit'] != null ){  
        $nit =  MedicoEspecialista::where('nit', $request->medico['nit'])->exists();
        //si existe el nit
        if( $nit ){
          return response()->json([
            'error' => 1,
            'msg' => "El número de nit: <b>$request->medico['nit']</b> Ya se encuentra registrado" 
          ]);
        }
      }

      if( $request->medico['user'] != null ){
        $email = User::where('email', $request->medico['user'])->exists();
        //si existe el email
        if( $email ){
          return response()->json([
            'error' => 1,
            'msg' => "El correo electrónico:&nbsp;<b>".$request->medico['user']."</b>&nbsp; ya se encuentra registrado" ]);
        }else{
          $user = new User;
          $user->name = $request->medico['nombre'];
          $user->email = $request->medico['user'];
          $user->password = bcrypt($request->medico['pass']);
          if( $user->save() ){
            $user_id = $user->id;
          }
        }
      }else{
        $user_id = 2;
      }
      //EL 2 ES EL CORREO ASOCIADO A LOS MEDICOS SIN CORREO DE ADMINISTRACIÓN PARA LA PLATAFORMA
      //registrar nuevo

      $medico                           = new MedicoEspecialista;
      $medico->user_id                  = $user_id;
      $medico->nombre                   = $request->medico['nombre'];
      $medico->nit                      = $request->medico['nit'];
      $medico->direccion                = $request->medico['direccion'];
      $medico->telefono                 = $request->medico['telefono'];
      $medico->celular                  = $request->medico['celular'];
      $medico->registro_medico          = $request->medico['registro_medico'];
      $medico->horario_consulta         = $request->medico['horario_consulta'];
      $medico->horario_procedimientos   = $request->medico['horario_precedimientos'];
      $medico->horario_cirujias         = $request->medico['horario_cirugias'];
      $medico->cargo                    = $request->medico['cargo'];
      $medico->especialidad_profesional = $request->medico['especialidad'];
      $medico->activo                   = 1;

      if( $medico->save() ){
        return response()->json(['yes' => 'Profesional Registrado Correctamente!',
                                  'medico' => $medico]);
      }else{
          return response()->json(['no' => 'No se pudo registrar']);
      }

    }
  }

  //actualizar Medico-Especialista
  public function editar(Request $request)
  {

    if($request->ajax()){

      //actualizar
      $medico                             = MedicoEspecialista::find($request->id);
      $medico->nombre                     = $request->medico['nombre'];
      $medico->nit                        = $request->medico['nit'];
      $medico->direccion                  = $request->medico['direccion'];
      $medico->telefono                   = $request->medico['telefono'];
      $medico->celular                    = $request->medico['celular'];
      $medico->registro_medico            = $request->medico['registro_medico'];
      $medico->horario_consulta           = $request->medico['horario_consulta'];
      $medico->horario_procedimientos     = $request->medico['horario_precedimientos'];
      $medico->horario_cirujias           = $request->medico['horario_cirugias'];
      $medico->cargo                      = $request->medico['cargo'];
      $medico->especialidad_profesional   = $request->medico['especialidad'];

      $usuario = User::find($medico->user_id);
      $usuario->name = $request->medico['nombre'];

      if( $medico->save() ){
        if( $medico->user_id != 2 ){
          if( !empty( $request->medico['pass'] ) ){
            $usuario->email = $request->medico['user'];
            $usuario->password = bcrypt($request->medico['pass']);
          }
        }
        if( $usuario->save() ){
          $user_id = $usuario->id;
        }
        return response()->json(['yes' => 'Profesional Actualizado Correctamente!', 'medico' => $medico]);
      }else{
        return response()->json(['no' => 'No se pudo actualizar el médico']);
      }

    }
  }

  public function correo(Request $request){
    if( $request->ajax() ){
      $user = User::find($request->id);
      return $user->email;
    }
  }

  //ver medico {{id}}
  public function ver(Request $request)
  {
    if($request->ajax()){
      
      $medico = MedicoEspecialista::find($request->id);
      return response()->json(['medico' => $medico]);

    }
  }

  //lista medicos ajax
  public function indexajax(Request $request)
  {
    if($request->ajax()){
      $medicos = MedicoEspecialista::all();
      //$medicos = DB::table('medicos_especialistas')->get();
      return response()->json(['medicos' => $medicos]);
    }
  }

  //Search In Live Medicos
  function buscar(Request $request)
  {
    if($request->ajax())
    {
      $output = '';
      $query = $request->get('query');
      if($query != ''){
        
        $data = MedicoEspecialista::where('nombre', 'like', '%'.$query.'%')
                  ->orWhere('nit', 'like', '%'.$query.'%')
                  ->orWhere('direccion', 'like', '%'.$query.'%')
                  ->orWhere('telefono', 'like', '%'.$query.'%')
                  ->orWhere('celular', 'like', '%'.$query.'%')
                  ->orWhere('registro_medico', 'like', '%'.$query.'%')
                  ->orderBy('id', 'asc')
                  ->get();
      }else{
        $data = MedicoEspecialista::all();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
        foreach($data as $row)
        {

          switch ($row->especialidad_profesional) {
            case 1:
              $row->especialidad_profesional = 'Medicina General';
              break;
            case 2:
              $row->especialidad_profesional = 'Psiquiatra';
              break;
            case 3:
              $row->especialidad_profesional = 'Psicologia';
              break;
            case 4:
              $row->especialidad_profesional = 'Fonaudiologia';
              break;
            case 5:
              $row->especialidad_profesional = 'Trabajo Social';
              break;
            case 6:
              $row->especialidad_profesional = 'Nutricionista';
              break;
            case 7:
              $row->especialidad_profesional = 'Otras Especialidades';
              break;
            default:
              $row->especialidad_profesional = 'No tiene especialidad';
              break;
          }

          $active_class = ($row->activo != 1 ) ? ' offline-user' : '';
          $texto_btn = ( $row->activo == 1 ) ? 'Desactivar' : 'Activar';
          $icon = ( $row->activo == 1 ) ? 'clear' : 'check';

          $output .= '
          <tr class="row-id" data-id="'.$row->id.'">
            <td><i class="material-icons">person</i></td>
            <td class="center id">'.$row->id.'</td>
            <td class="center nit">'.$row->nit.'</td>
            <td class="center nombre">'.$row->nombre.'</td>
            <td class="center registro_medico">'.$row->registro_medico.'</td>
            <td class="center cargo">'.$row->cargo.'</td>
            <td class="center especialidad_profesional">'.$row->especialidad_profesional.'</td>
            <td class="center telefono">'.$row->telefono.'</td>
            <td class="center celular">'.$row->celular.'</td>
            <td class="center">
              <a class="tooltipped blue darken-4 waves-effect waves-light btn dev-ver-profesional" data-position="top" data-tooltip="Ver"><i class="material-icons left">remove_red_eye</i></a>
            </td>
            <td class="center">
              <a class="tooltipped blue darken-4 waves-effect waves-light btn dev-edit-profesional" data-position="top" data-tooltip="Editar"><i class="material-icons left">edit</i></a>
            </td>
            <td class="center">
              <a class="tooltipped blue darken-4 waves-effect waves-light btn dev-offline-profesional'.$active_class.'" data-position="top" data-tooltip="'.$texto_btn.'" data-id="'.$row->id.'"><i class="material-icons left">'.$icon.'</i></a>
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

}