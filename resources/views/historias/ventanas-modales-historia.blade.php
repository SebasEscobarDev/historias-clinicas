<!-- Lista de pacientes -->
<div class="col-md-12 justify-content-center dev-pacientes">
	<div class="dev-table-sebas modal-table">
		<div class="dev-table-head"></div>
		<div class="dev-table-fix">
			<div class="body-modal">
				<div class="paciente-option">
					<table class="highlight responsive-table striped">
						<thead>
							<tr>
								<th>ID</th>
								<th>Documento</th>
								<th>Nombre</th>
								<th>Edad</th>
								<th>Sexo</th>
								<th>Celular</th>
								<th></th>
							</tr>
						</thead>
						<tbody id="table-pacientes-2">
							@foreach ($pacientes as $paciente)
								@php
								if( $paciente->nombre_2 == '' || empty($paciente->nombre_2) ){
									$paciente->nombre_2 = '-';
								};
								if( $paciente->telefono == '' || empty($paciente->telefono) ){
									$paciente->telefono = '-';
								};
								@endphp
							<tr>
								<td class="center">{{$paciente->id}}</td>
								<td class="center">{{$paciente->documento}}</td>
								<td class="center">{{$paciente->nombre_1}} {{$paciente->nombre_2}} {{$paciente->apellido_1}} {{$paciente->apellido_2}}</td>
								<td class="center">{{$paciente->edad}}</td>
								<td class="center">{{$paciente->sexo}}</td>
								<td class="center">{{$paciente->celular}}</td>
								<td class="center">
									<a href="#!" class="modal-close blue darken-4 waves-effect waves-light btn dev-select-paciente" data-select="{{$paciente->id}}">
										<i class="material-icons left text-white">add</i>
									</a>
									<div class="position-absolute invisible info-paciente dev-detail-paciente-{{$paciente->id}}">
										<div class="col s12 details-paciente">
											<div class="table-responsive">
												<table>
													<tbody>
														<tr class="tds-details">
															<td class="hidden"><b>ID:</b><br> <span class="paciente-id">{{ $paciente->id }}</span></td>
															<td>
																<b>Nombre 1:</b><br>
																<span>{{ $paciente->nombre_1 }}</span>
															</td>
															<td>
																<b>Nombre 2:</b><br>
																<span>{{ $paciente->nombre_2 }}</span>
															</td>
															<td>
																<b>Apellido 1:</b><br>
																<span>{{ $paciente->apellido_1 }}</span>
															</td>
															<td>
																<b>Apellido 2:</b><br>
																<span>{{ $paciente->apellido_2 }}</span>
															</td>
															<td>
																<b>Tipo de Documento:</b><br>
																<span>{{ $paciente->tipo_id }}</span>
															</td>
															<td class="td-documento"><b>Documento:</b><br> <span class="doc-paciente">{{ $paciente->documento }}</span></td>
														</tr>
														<tr>
															<td><b>Fecha de Nacimiento:</b><br> {{ $paciente->f_nacimiento }}</td>
															<td><b>Edad:</b><br> {{ $paciente->edad }}</td>
															<td><b>Rh:</b><br> {{ $paciente->rh }}</td>
															<td><b>Sexo:</b><br> {{ $paciente->sexo }}</td>
															<td><b>Direccion:</b><br> {{ $paciente->direccion }}</td>
															<td><b>Telefono:</b><br> {{ $paciente->telefono }}</td>
															<td><b>Celular:</b><br> {{ $paciente->celular }}</td>
														</tr>
														<tr>
															<td><b>Correo:</b><br> {{ $paciente->correo }}</td>
															<td><b>Clase:</b><br> {{ $paciente->clase }}</td>
															<td><b>Afiliacion:</b><br> {{ $paciente->afiliacion }}</td>
															<td><b>Ocupacion:</b><br> {{ $paciente->ocupacion }}</td>
															<td><b>Departamento:</b><br> {{ $paciente->municipio->nombre}}</td>
															<td><b>Municipio:</b><br> {{ $paciente->municipio->departamento->nombre }}</td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Structure -->
	<div id="modal1" class="modal modal-fixed-footer buscador-pacientes">
		<div class="modal-header">
			<div class="col s12 card-panel blue darken-2 dev-card-sub-title">
				<h5 style="margin:0px" class="text-center text-white"><b>LISTA DE PACIENTES</b></h5>
				<a href="#!" class="waves-effect waves-light btn blue darken-4" id="btn-buscar-pacientes" data-click="0">
					<i class="material-icons">search</i>
				</a>
			</div>
		</div>
		<div class="modal-content-table">
			@include('historias.buscar', ['id'=>'buscar-pacientes', 'text'=>'Buscar Pacientes'])
		</div>
		<div class="modal-footer dev-buttons">
			<a href="#!" class="modal-close waves-effect waves-light btn blue darken-4">
				<i class="material-icons left">chevron_left</i>
				Volver
			</a>
	    </div>
		<!--div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-light btn blue darken-4">Agree</a>
		</div-->
	</div>
</div>

<!-- Lista de Medicamentos --> 

<div class="col-md-12 justify-content-center dev-medicamentos">
	<div class="dev-table-sebas modal-table">
		<div class="dev-table-head"></div>
		<div class="dev-table-fix">
			<div class="body-modal">
				<div class="paciente-option">
					<table class="table-icon highlight responsive-table striped">
						<thead>
							<tr>
								<th class="center">ID</th>
								<th class="center">Código CUM</th>
								<th class="center">Nombre</th>
								<th class="center">T.M.</th>
								<th class="center"></th>
							</tr>
						</thead>
						<tbody id="table-medicamentos">
							@foreach ($medicamentos as $medicamento)
								@php
									if( $medicamento->codigo_cum == '' || empty($medicamento->codigo_cum) ){
										$medicamento->codigo_cum = '';
									}
									if( $medicamento->clase_prod == '' || empty( $medicamento->clase_prod ) ){
										$medicamento->clase_prod = '';
									}
								@endphp
								<tr class="medicamento-{{$medicamento->id}}">
									<td class="center m-id">{{$medicamento->id}}</td>
									<td class="center m-codigo_cum">{{$medicamento->codigo_cum}}</td>
									<td class="center m-nombre_far">{{$medicamento->nombre_far}}</td>
									<td class="center m-clase_prod">{{$medicamento->clase_prod}}</td>
									<td class="hide m-presentacion">{{$medicamento->presentacion}}</td>
									<td class="center">
										<a href="#!" class="modal-close blue darken-4 waves-effect waves-light btn dev-select-medicamento" data-select="{{$medicamento->id}}">
											<i class="material-icons left text-white">add</i>
										</a>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Structure -->
	<div id="modal_medicamentos" class="modal modal-fixed-footer buscador-medicamentos">
		<div class="modal-header">
			<div class="col s12 card-panel blue darken-2 dev-card-sub-title">
				<h5 style="margin:0px" class="text-center text-white">LISTA DE MEDICAMENTOS</h5>
				<a href="#!" class="waves-effect waves-light btn blue darken-4" id="btn-buscar-medicamentos" data-click="0">
					<i class="material-icons">search</i>
				</a>
			</div>
		</div>
		<div class="modal-content-table">
			@include('historias.buscar', ['id'=>'buscar-medicamentos', 'text'=>'Buscar Medicamentos'])
			
		</div>
		<div class="modal-footer dev-buttons">
			<a href="#!" class="modal-close waves-effect waves-light btn blue darken-4">
				<i class="material-icons left">chevron_left</i>
				Volver
			</a>
	    </div>
	</div>

</div>


<!-- ordenes medicas -->
<div class="col s12 justify-content-center">
	<!-- Modal Structure -->
	<div id="modal_ordenes" class="modal modal-fixed-footer">
		<div class="modal-header">
			<div class="col s12 card-panel blue darken-2 dev-card-sub-title">
				<h5 style="margin:0px" class="text-center text-white"><b>ORDENES MÉDICAS</b></h5>
			</div>
		</div>
		<div class="modal-content-table">
			<div class="body-modal col-md-12">
				<div class="row formulas-medicas">
					<div class="col-md-2">
						<br>
						<div class="row card-header card-panel blue darken-2 text-white" style="padding: 7px;top: 2px;position: relative;">
							<div class="col-md-3">#</div>
							<div class="col-md-9 text-center">Fecha</div>
						</div>
				    <table>
				    	<tbody id="js-ordenes-lista-fechas">
				    		<!--<tr><td>2019/08/08</td></tr>-->
				    		<!-- CONTENT CHARGE WITH VER_HISTORIA => historias.js  -->
				    	</tbody>
				    </table>
				  </div>
				  <div class="col-md-10 detalles-formula">
				  	<br>
						<table class="listando-formulas">
							<tbody id="js-ordenes-lista-formulas">
								<!-- CONTENT CHARGE WITH VER_HISTORIA => historias.js  -->
							</tbody>
						</table>
				  </div>
				</div>
			</div>
		</div>
		<div class="modal-footer dev-buttons">
			<a href="#!" class="modal-close waves-effect waves-light btn blue darken-4">
				<i class="material-icons left">chevron_left</i>
				Volver
			</a>
	    </div>
		<!--div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-light btn blue darken-4">Agree</a>
		</div-->
	</div>
</div>

<!-- paraclinicos -->
<div class="col s12 justify-content-center">
	<!-- Modal Structure -->
	<div id="modal_paraclinicos" class="modal modal-fixed-footer">
		<div class="modal-header">
			<div class="col s12 card-panel blue darken-2 dev-card-sub-title">
				<h5 style="margin:0px" class="text-center text-white"><b>Paraclinicos</b></h5>
			</div>
		</div>
		<div class="modal-content-table">
			<div class="body-modal col-md-12">
				<div class="row formulas-medicas">
					<div class="col-md-2">
						<br>
						<div class="row card-header card-panel blue darken-2 text-white" style="padding: 7px;top: 2px;position: relative;">
							<div class="col-md-3">#</div>
							<div class="col-md-9 text-center">Fecha</div>
						</div>
				    <table>
				    	<tbody id="js-paraclinicos-lista-fechas">
				    		<!--<tr><td>2019/08/08</td></tr>-->
				    		<!-- CONTENT CHARGE WITH VER_HISTORIA => historias.js  -->
				    	</tbody>
				    </table>
				  </div>
				  <div class="col-md-10 detalles-formula">
				  	<br>
						<table class="listando-formulas">
							<tbody id="js-paraclinicos-lista-formulas">
								<!-- CONTENT CHARGE WITH VER_HISTORIA => historias.js  -->
							</tbody>
						</table>
				  </div>
				</div>
			</div>
		</div>
		<div class="modal-footer dev-buttons">
			<a href="#!" class="modal-close waves-effect waves-light btn blue darken-4">
				<i class="material-icons left">chevron_left</i>
				Volver
			</a>
	    </div>
		<!--div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-light btn blue darken-4">Agree</a>
		</div-->
	</div>
</div>


<!-- incapacidades -->
<div class="col s12 justify-content-center">
	<!-- Modal Structure -->
	<div id="modal_incapacidades" class="modal modal-fixed-footer">
		<div class="modal-header">
			<div class="col s12 card-panel blue darken-2 dev-card-sub-title">
				<h5 style="margin:0px" class="text-center text-white"><b>Incapacidades</b></h5>
			</div>
		</div>
		<div class="modal-content-table">
			<div class="body-modal col-md-12">
				<div class="row formulas-medicas">
					<div class="col-md-2">
						<br>
						<div class="row card-header card-panel blue darken-2 text-white" style="padding: 7px;top: 2px;position: relative;">
							<div class="col-md-3">#</div>
							<div class="col-md-9 text-center">Fecha</div>
						</div>
				    <table>
				    	<tbody id="js-incapacidades-lista-fechas">
				    		<!-- CONTENT CHARGE WITH VER_HISTORIA => historias.js  -->
				    	</tbody>
				    </table>
				  </div>
				  <div class="col-md-10 detalles-formula">
				  	<br>
						<table class="listando-formulas">
							<tbody id="js-incapacidades-lista-formulas">
								<!-- CONTENT CHARGE WITH VER_HISTORIA => historias.js  -->
							</tbody>
						</table>
				  </div>
				</div>
			</div>
		</div>
		<div class="modal-footer dev-buttons">
			<a href="#!" class="modal-close waves-effect waves-light btn blue darken-4">
				<i class="material-icons left">chevron_left</i>
				Volver
			</a>
	    </div>
		<!--div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-light btn blue darken-4">Agree</a>
		</div-->
	</div>
</div>


<!-- referencias -->
<div class="col s12 justify-content-center">
	<!-- Modal Structure -->
	<div id="modal_referencias" class="modal modal-fixed-footer">
		<div class="modal-header">
			<div class="col s12 card-panel blue darken-2 dev-card-sub-title">
				<h5 style="margin:0px" class="text-center text-white"><b>Referencias</b></h5>
			</div>
		</div>
		<div class="modal-content-table">
			<div class="body-modal col-md-12">
				<div class="row formulas-medicas">
					<div class="col-md-2">
						<br>
						<div class="row card-header card-panel blue darken-2 text-white" style="padding: 7px;top: 2px;position: relative;">
							<div class="col-md-3">#</div>
							<div class="col-md-9 text-center">Fecha</div>
						</div>
				    <table>
				    	<tbody id="js-referencias-lista-fechas">
				    		<!-- CONTENT CHARGE WITH VER_HISTORIA => historias.js  -->
				    	</tbody>
				    </table>
				  </div>
				  <div class="col-md-10 detalles-formula">
				  	<br>
						<table class="listando-formulas">
							<tbody id="js-referencias-lista-formulas">
								<!-- CONTENT CHARGE WITH VER_HISTORIA => historias.js  -->
							</tbody>
						</table>
				  </div>
				</div>
			</div>
		</div>
		<div class="modal-footer dev-buttons">
			<a href="#!" class="modal-close waves-effect waves-light btn blue darken-4">
				<i class="material-icons left">chevron_left</i>
				Volver
			</a>
	    </div>
		<!--div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-light btn blue darken-4">Agree</a>
		</div-->
	</div>
</div>


<!-- evoluciones -->
<div class="col s12 justify-content-center">
	<!-- Modal Structure -->
	<div id="modal_evolucion" class="modal modal-fixed-footer">
		<div class="modal-header">
			<div class="col s12 card-panel blue darken-2 dev-card-sub-title">
				<h5 style="margin:0px" class="text-center text-white"><b>Evoluciones</b></h5>
			</div>
		</div>
		<div class="modal-content-table">
			<div class="body-modal col-md-12">
				<div class="row formulas-medicas">
					<div class="col-md-2">
						<br>
						<div class="row card-header card-panel blue darken-2 text-white" style="padding: 7px;top: 2px;position: relative;">
							<div class="col-md-3">#</div>
							<div class="col-md-9 text-center">Fecha</div>
						</div>
				    <table>
				    	<tbody id="js-evoluciones-lista-fechas">
				    		<!-- CONTENT CHARGE WITH VER_HISTORIA => historias.js  -->
				    	</tbody>
				    </table>
				  </div>
				  <div class="col-md-10 detalles-formula">
				  	<br>
						<table class="listando-formulas">
							<tbody id="js-evoluciones-lista-formulas">
								<!-- CONTENT CHARGE WITH VER_HISTORIA => historias.js  -->
							</tbody>
						</table>
				  </div>
				</div>
			</div>
		</div>
		<div class="modal-footer dev-buttons">
			<a href="#!" class="modal-close waves-effect waves-light btn blue darken-4">
				<i class="material-icons left">chevron_left</i>
				Volver
			</a>
	    </div>
		<!--div class="modal-footer">
		<a href="#!" class="modal-close waves-effect waves-light btn blue darken-4">Agree</a>
		</div-->
	</div>
</div>