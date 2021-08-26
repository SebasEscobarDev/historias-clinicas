<?php

namespace GestionClinica\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GestionClinica\Http\Controllers\Controller;
use GestionClinica\Entidad;


class EntidadesController extends Controller
{

	public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('admin', ['only' => 'index']);
  }

  //Index view
  public function index()
  {
    //$registro = $request->session()->get('update');
   $entidades = Entidad::all();
    return view('entidades.index', [
      'entidades' => $entidades,
    ]);
  }

  //Crear Entidad
  public function crear(Request $request)
  {

    if($request->ajax()){

      $entidad = new Entidad;
      $entidad->nit_entidad = $request->entidad['nit_entidad'];
      $entidad->nombre_entidad = $request->entidad['nombre_entidad'];
      $entidad->direccion = $request->entidad['direccion'];
      $entidad->telefonos = $request->entidad['telefonos'];
      if( $entidad->save() ){
        return response()->json(['yes' => 'Nueva Entidad Registrada Correctamente!',
                                  'entidad' => $entidad]);
      }else{
        return response()->json(['no' => 'No se pudo registrar']);
      }
    }

  }

  //actualizar Paciente
  public function editar(Request $request)
  {
    if($request->ajax()){

      //actualizar
      $entidad               		= Entidad::find($request->id);
      $entidad->nit_entidad 		= $request->entidad['nit_entidad'];
      $entidad->nombre_entidad 	= $request->entidad['nombre_entidad'];
      $entidad->direccion 			= $request->entidad['direccion'];
      $entidad->telefonos 			= $request->entidad['telefonos'];

      if( $entidad->save() ){
        return response()->json([
          'yes' => 'Entidad Actualizada Correctamente!',
          'entidad' => $entidad
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

      $entidad = Entidad::find($request->id);
      return response()->json(['entidad' => $entidad]);

    }
  }


  //Metodo para actualizar estado activo
  public function active(Request $request)
  {
    if($request->ajax()){
      
      $entidad = Entidad::find( $request->id );
      $entidad->activo = ( $entidad->activo == 0 ) ? 1 : 0;
      if( $entidad->save() ) {
        return response()->json(['activo' => $entidad->activo]);
      }

    }
  }

  //Search In Live Entidades
  function buscar(Request $request)
  {
    if($request->ajax())
    {
      $output = '';
      $query = $request->get('query');
      if($query != ''){

        $data = Entidad::where('nit_entidad', 'like', '%'.$query.'%')
          ->orWhere('nombre_entidad', 'like', '%'.$query.'%')
          ->orWhere('direccion', 'like', '%'.$query.'%')
          ->orWhere('telefonos', 'like', '%'.$query.'%')
          ->orderBy('id', 'asc')
          ->get();
      }else{
        $data = Entidad::all();
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
							<td class="center id" >'.$row->id.'</td>
							<td class="center nit_entidad" >'.$row->nit_entidad.'</td>
							<td class="center nombre_entidad" >'.$row->nombre_entidad.'</td>
							<td class="center direccion" >'.$row->direccion.'</td>
							<td class="center telefonos" >'.$row->telefonos.'</td>
							
							<td class="center">
								<a class="tooltipped blue darken-4 waves-effect waves-light btn dev-ver-entidad" data-position="top" data-tooltip="Ver"><i class="material-icons left">remove_red_eye</i></a>
							</td>
							<td class="center">
								<a class="tooltipped blue darken-4 waves-effect waves-light btn dev-edit-entidad" data-position="top" data-tooltip="Editar"><i class="material-icons left">edit</i></a>
							</td>
              <td class="center">
                <a class="tooltipped blue darken-4 waves-effect waves-light btn dev-active-entidad'.$active_class.'" data-position="top" data-tooltip="'.$texto_btn.'" data-id="'.$row->id.'"><i class="material-icons left">'.$icon.'</i></a>
              </td>
						</tr>';
        }
      }else{
        $output = '
        <tr>
        <td align="center" colspan="5">No se encontraron Resultados</td>
        </tr>
        ';
      }

      $data = array(
        'table_data'  => $output,
        'total_data'  => $total_row,
      );
      echo json_encode($data);
    }
  }

}
