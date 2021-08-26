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

	@if( count($pacientes) > 0 )

		@include('pacientes.buscar')

		<div class="dev-table-sebas">
			<div class="dev-table-head"></div>
			<div class="dev-table-fix">

				<table class="center highlight dev-table">
					<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>Tipo Doc.</th>
							<th>Documento</th>
							<th>Nombre</th>
							<th>Edad</th>
							<th>Sexo</th>
							<th>Celular</th>
							<th colspan="3">Acciones</th>
						</tr>
					</thead>

					<tbody class="list" id="table-pacientes">
						@foreach ($pacientes as $paciente)
							<tr class="row-id" data-id="{{ $paciente->id }}">
								<td><i class="material-icons">person</i></td>
								<td class="center id">{{ $paciente->id }}</td>
								<td class="center d-none identificacion_id">{{ $paciente->identificacion->id }}</td>
								<td class="center name">{{ $paciente->identificacion->name }}</td>
								<td class="center documento">{{ $paciente->documento }}</td>	

								<td class="center full-name">
									<span class="nombre_1">{{ $paciente->nombre_1 }}</span>
									<span class="nombre_2">{{ $paciente->nombre_2 }}</span>
									<span class="apellido_1">{{ $paciente->apellido_1 }}</span>
									<span class="apellido_2">{{ $paciente->apellido_2 }}</span>
								</td>

								<td class="center edad">{{ $paciente->edad }}</td>
								<td class="center sexo">{{ $paciente->sexo }}</td>
								<td class="center celular">{{ $paciente->celular }}</td>

								
								<td class="center">
									<a class="tooltipped blue darken-4 waves-effect waves-light btn dev-ver-paciente" data-position="top" data-tooltip="Ver"><i class="material-icons left">remove_red_eye</i></a>
								</td>
								<td class="center">
									<a class="tooltipped blue darken-4 waves-effect waves-light btn dev-edit-paciente" data-position="top" data-tooltip="Editar"><i class="material-icons left">edit</i></a>
								</td>
								<td class="center">
									@php
									$active_class = ($paciente->activo != 1 ) ? ' offline-user' : '';
									$texto_btn = ( $paciente->activo == 1 ) ? 'Desactivar' : 'Activar';
									$icon = ( $paciente->activo == 1 ) ? 'clear' : 'check';
									@endphp 
									<a class="tooltipped blue darken-4 waves-effect waves-light btn dev-offline-paciente<?=$active_class?>" data-id="{{$paciente->id}}" data-position="top" data-tooltip="<?=$texto_btn?>"><i class="material-icons left"><?=$icon?></i></a>
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
			<h4>No hay Registro de Pacientes</h4>
		</div>
	@endif
	<br>
</div>
