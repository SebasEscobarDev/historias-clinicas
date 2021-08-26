<div class="row no-margg">
	<div class="col-md-9">
  	<div class="row">
  		<div class="input-field col-md-1">
  			{!! Form::number('td', null, ['id' => 'td', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('td', 'Td') !!}
			</div>
			<div class="input-field col-md-2">
				{!! Form::number('formula', null, ['id' => 'formula', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('formula', 'Formula Nº') !!}
			</div>
			<div class="input-field col-md-2">
				{!! Form::text('o_fecha', null, ['id' => 'o_fecha', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('o_fecha', 'Fecha') !!}
			</div>
			<div class="input-field col-md-7 cata-marg-select">
		    {!! Form::select('o_entidad', $array_entidades, 0, ['id' => 'o_entidad']) !!}
		    {!! Form::label('o_entidad', 'Entidad') !!}
		  </div>
		  <div class="input-field cata-marg-select col-md-12">
		    {!! Form::select('o_profesional_medico', $arr_medicos , 0, ['id' => 'o_profesional_medico']) !!}
		    {!! Form::label('o_profesional_medico', 'Profesional Médico') !!}
		  </div>
		  <div class="input-field col-md-12">
		  	{!! Form::textarea('o_antecedentes_alergicos', null, ['id' => 'o_antecedentes_alergicos', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
				{!! Form::label('o_antecedentes_alergicos', 'Antecedentes Alergicos') !!}
		  </div>
		  <div class="center col-md-12">
		  	<h5>
		  		<!-- Modal Trigger -->
					<a class="waves-effect waves-light btn blue darken-4 modal-trigger dev-btn-with-icon-30" id="registrar_medicamentos" href="#modal_medicamentos">
						Seleccionar Medicamentos
						<i class="material-icons">playlist_add</i>
					</a>
		  	</h5>
		  </div>
		  <div class="col-md-12">
		  	<table id="table_medicamentos" class="centered striped">
		  		<thead>
		  			<tr>
		  				<th>ID</th>
		  				<th>Código CUM</th>
		  				<th>Nombre</th>
		  				<th>Presentación</th>
		  				<th>Cantidad</th>
		  				<th>Dosis</th>
		  				<th>Días / Meses</th>
		  			</tr>
		  		</thead>
		  		<tbody class="body_medicamentos">
		  		</tbody>
		  	</table>
		  </div>
		</div>
  </div>
  <div class="col-md-3">
  	<div class="row justify-content-center">
			<div class="buttons-ordenes text-center">
				<br>
	  		<br>
	  		<br>
	  		<br>
	  		<br>
				<a class="waves-effect waves-light btn blue darken-4 dev-btn-with-icon-20" id="guardar_orden">
					<i class="material-icons left">save</i>
					Guardar Orden
				</a><br>
				<!-- Modal Trigger -->
				<a class="waves-effect waves-light btn blue darken-4 modal-trigger dev-btn-with-icon-20" id="consultar_ordenes" href="#modal_ordenes">
					<i class="material-icons">search</i>
					Consultar Ordenes
				</a>
			</div>
		</div>
  </div>
</div>