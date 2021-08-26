<div class="col s12 vistas" id="list">

	<div class="row justify-content-center btn-register">
		<div class="dev-buttons">
			<a class="blue darken-4 waves-effect waves-light btn btn-registrar" data-view="create">
				<i class="material-icons left">person_add</i>
				Agregar
			</a>
		</div>
	</div>

	<br>

	<div class="row no-marg-bott hide">
		<div class="alerts col s12">
			@if (session()->has('update'))
				<br>
                <?php
                    $value = session()->get('message-error')
                ?>
				<div class="alert alert-error">
				  <strong>{!! $value !!}</strong>
				</div>

			@endif
		</div>
	</div>
@if( count($medicos) > 0 )

	@include('medico_especialista.buscar')
	
	<div class="dev-table-sebas">
		<div class="dev-table-head"></div>
		<div class="dev-table-fix">
			<table class="center highlight dev-table">
				<thead>
				  <tr>
						<th></th>
						<th>ID</th>
						<th>NIT</th>
						<th>Profesional</th>
						<th>Registro médico</th>
						<th>Cargo</th>
						<th>Especialidad</th>
						<th>Teléfono</th>
						<th>Celular</th>
						<th colspan="3">Acciones</th>
				  </tr>
				</thead>

				<tbody class="list" id="profesionales-medicos">
					@foreach ($medicos as $medico)
						<tr class="row-id" data-id="{{ $medico->id }}">
							<td><i class="material-icons">person</i></td>
							<td class="center id">{{ $medico->id }}</td>
							<td class="center nit">{{ $medico->nit }}</td>
							<td class="center nombre">{{ $medico->nombre }}</td>
							<td class="center registro_medico">{{ $medico->registro_medico }}</td>
							<td class="center cargo">{{ $medico->cargo }}</td>
							<td class="center especialidad_profesional">
								@if( $medico->especialidad_profesional == 1 )
									Medicina General
								@elseif( $medico->especialidad_profesional == 2 )
									Psiquiatra
								@elseif( $medico->especialidad_profesional == 3 )
									Psicologia
								@elseif( $medico->especialidad_profesional == 4 )
									Fonaudiologia
								@elseif( $medico->especialidad_profesional == 5 )
									Trabajo Social
								@elseif( $medico->especialidad_profesional == 6 )
									Nutricionista
								@elseif( $medico->especialidad_profesional == 7 )
									Otras Especialidades
								@else
									No tiene especialidad
								@endif
							</td>
							<td class="center telefono">{{ $medico->telefono }}</td>
							<td class="center celular"> {{ $medico->celular }} </td>
							<td class="center">
								<a class="tooltipped blue darken-4 waves-effect waves-light btn dev-ver-profesional" data-position="top" data-tooltip="Ver"><i class="material-icons left">remove_red_eye</i></a>
							</td>
							<td class="center">
								<a class="tooltipped blue darken-4 waves-effect waves-light btn dev-edit-profesional" data-position="top" data-tooltip="Editar"><i class="material-icons left">edit</i></a>
							</td>
							<td class="center">
								@php
								$active_class = ($medico->activo != 1 ) ? ' offline-user' : '';
								$texto_btn = ( $medico->activo == 1 ) ? 'Desactivar' : 'Activar';
								$icon = ( $medico->activo == 1 ) ? 'clear' : 'check';
								@endphp 
								<a class="tooltipped blue darken-4 waves-effect waves-light btn dev-offline-profesional<?=$active_class?>" data-id="{{$medico->id}}" data-position="top" data-tooltip="<?=$texto_btn?>"><i class="material-icons left"><?=$icon?></i></a>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
@else
	<br>
	<br>
	<div class="col s12 center">
		<h4>No hay Registro de Médicos</h4>
	</div>
@endif
	<br>
</div>
