<div class="col s12 vistas" id="list">

	<div class="row justify-content-center btn-register">
		<div class="dev-buttons col s12">
			<a class="blue darken-4 waves-effect waves-light btn modal-trigger float-right tooltipped" data-position="bottom" data-tooltip="Seleccionar Paciente para Historia Médica" href="#modal1">
				Seleccionar Paciente
				<i class="material-icons left">assignment_ind</i>
			</a>
		</div>
	</div>
	@if( count($historias) > 0 )
	<div class="dev-table-sebas">
		<div class="dev-table-head"></div>
		<div class="dev-table-fix">
			<table class="center highlight dev-table striped">
				<thead>
					<tr>
						<th></th>
						<th>Historia Nº</th>
						<th>Fecha y Hora</th>
						<th>Documento</th>
						<th>Nombre del Paciente</th>
						<th>Edad</th>
						<th>Municipio</th>
						<th>Acciones</th>
					</tr>
				</thead>

				<tbody class="list lista-historias">
					@foreach ( $historias as $historia )
						<tr class="row-id" data-id="{{ $historia->id }}">
							<td class="center"><i class="material-icons">description</i></td>
							<td class="center id">{{ $historia->id }}</td>
							<td class="center f_historia">{{ $historia->created_at }}</td>
							<td class="center documento">{{ $historia->paciente->documento }}</td>
							<td class="center nombre">
								<?php
									$nombrePaciente = $historia->paciente->nombre_1." ".$historia->paciente->nombre_2." ".$historia->paciente->apellido_1." ".$historia->paciente->apellido_2;
								?>
								{{ $nombrePaciente }}
							</td>
							<td class="center edad">{{ $historia->paciente->edad }}</td>
							<td class="center sexo">{{ $historia->paciente->municipio->nombre }}</td>
							<td class="center">
								<a class="blue darken-4 waves-effect waves-light btn dev-count-historia" data-edit="{{$historia->id}}">
									<i class="material-icons left">edit</i>
									Continuar
								</a>
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
			<h4>No hay Registro de Historias de Pacientes</h4>
		</div>
	@endif 
	<br>
</div>
