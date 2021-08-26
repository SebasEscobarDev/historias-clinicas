<div class="row no-margg">
	<div class="col-md-10">
  	<div class="row">
  		<div class="input-field col-md-1">
  			{!! Form::number('r_td', null, ['id' => 'r_td', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('r_td', 'Td') !!}
			</div>
			<div class="input-field col-md-2">
				{!! Form::number('remision', null, ['id' => 'remision', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('remision', 'Remisión Nº') !!}
			</div>
			<div class="input-field col-md-2">
				{!! Form::text('r_fecha', null, ['id' => 'r_fecha', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('r_fecha', 'Fecha') !!}
			</div>
			<div class="input-field col-md-2">
				{!! Form::text('r_hora', null, ['id' => 'r_hora', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('r_hora', 'Hora') !!}
		  </div>
			<div class="input-field col-md-5 cata-marg-select">
		    {!! Form::select('r_entidad', $array_entidades, 0, ['id' => 'r_entidad']) !!}
		    {!! Form::label('r_entidad', 'Entidad') !!}
		  </div>
		  <div class="input-field cata-marg-select col-md-6">
		    {!! Form::select('r_profesional_medico', $arr_medicos , null, ['id' => 'r_profesional_medico']) !!}
		    {!! Form::label('r_profesional_medico', 'Médico Que Realiza Remisión') !!}
		  </div>
		  <div class="input-field col-md-6">
		  	{!! Form::text('especialidad', null, ['id' => 'especialidad', 'class' => 'validate']) !!}
				{!! Form::label('especialidad', 'Especialidad a La Cual Se Realiza La Remision ') !!}
		  </div>
		  <div class="input-field col-md-12 cata-marg-select">
		    {!! Form::select('r_diagnostico', [
          0 => '...',
          1 => 'Diagnóstico 1',
          2 => 'Diagnóstico 2',
          3 => 'Diagnóstico 3',
          ], 0, ['id' => 'r_diagnostico']) !!}
		    {!! Form::label('r_diagnostico', 'Diagnóstico') !!}
		  </div>
		  <div class="input-field col-md-12">
		  	{!! Form::textarea('r_enfermedad_actual', null, ['id' => 'r_enfermedad_actual', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
				{!! Form::label('r_enfermedad_actual', 'Enfermedad Actual') !!}
		  </div>
		  <!-- contra	hallazgos	examenes	tratamiento -->
		  <div class="col-md-12 card-panel blue darken-2 dev-card-sub-title">
				<h5 style="margin:0px" class="text-center text-white"><b>CONTRA - REFERENCIA</b></h5>
			</div>
		  <div class="input-field col-md-3">
				{!! Form::text('contra', null, ['id' => 'contra', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('contra', 'Fecha Contra') !!}
			</div>
		  <div class="input-field col-md-9">
		  	{!! Form::textarea('hallazgos', null, ['id' => 'hallazgos', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
				{!! Form::label('hallazgos', 'Hallazgos') !!}
		  </div>
		  <div class="input-field col-md-6">
		  	{!! Form::textarea('exameness', null, ['id' => 'exameness', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
				{!! Form::label('exameness', 'Examenes') !!}
		  </div>
		  <div class="input-field col-md-6">
		  	{!! Form::textarea('r_tratamiento', null, ['id' => 'r_tratamiento', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
				{!! Form::label('r_tratamiento', 'Tratamiento') !!}
		  </div>

		</div>
	</div>
	<div class="col-md-2">
  	<div class="row justify-content-center">
			<div class="buttons-ordenes text-center">
				<br>
	  		<br>
	  		<br>
	  		<br>
	  		<br>
				<a class="waves-effect waves-light btn blue darken-4 dev-btn-with-icon-20" id="guardar_referencia">
					<i class="material-icons left">save</i>
					Guardar
				</a><br>
				<!-- Modal Trigger -->
				<a class="waves-effect waves-light btn blue darken-4 modal-trigger dev-btn-with-icon-20" id="consultar_referencias" href="#modal_referencias">
					<i class="material-icons">search</i>
					Consultar
				</a>
			</div>
		</div>
  </div>
</div>