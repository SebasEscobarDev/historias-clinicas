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

	@if( count($entidades) > 0 )

		@include('entidades.buscar')

		<div class="dev-table-sebas">
			<div class="dev-table-head"></div>
			<div class="dev-table-fix">

				<table class="center highlight dev-table">
					<thead>
						<tr>
							<th></th>
							<th>ID</th>
							<th>nit_entidad</th>
							<th>nombre_entidad</th>
							<th>direccion</th>
							<th>telefonos</th>
							<th colspan="3">Acciones</th>
						</tr>
					</thead>

					<tbody class="list" id="table-entidades">
						@foreach ($entidades as $entidad)
							<tr class="row-id" data-id="{{ $entidad->id }}">
								<td><i class="material-icons">person</i></td>
								<td class="center id" >{{$entidad->id}}</td>
								<td class="center nit_entidad" >{{$entidad->nit_entidad}}</td>
								<td class="center nombre_entidad" >{{$entidad->nombre_entidad}}</td>
								<td class="center direccion" >{{$entidad->direccion}}</td>
								<td class="center telefonos" >{{$entidad->telefonos}}</td>
								
								<td class="center">
									<a class="tooltipped blue darken-4 waves-effect waves-light btn dev-ver-entidad" data-position="top" data-tooltip="Ver"><i class="material-icons left">remove_red_eye</i></a>
								</td>
								<td class="center">
									<a class="tooltipped blue darken-4 waves-effect waves-light btn dev-edit-entidad" data-position="top" data-tooltip="Editar"><i class="material-icons left">edit</i></a>
								</td>
								<td class="center">
									@php
									$active_class = ($entidad->activo != 1 ) ? ' offline-user' : '';
									$texto_btn = ( $entidad->activo == 1 ) ? 'Desactivar' : 'Activar';
									$icon = ( $entidad->activo == 1 ) ? 'clear' : 'check';
									@endphp 
									<a class="tooltipped blue darken-4 waves-effect waves-light btn dev-active-entidad<?=$active_class?>" data-id="{{$entidad->id}}" data-position="top" data-tooltip="<?=$texto_btn?>"><i class="material-icons left"><?=$icon?></i></a>
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
