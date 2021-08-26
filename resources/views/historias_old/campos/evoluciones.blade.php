<div class="row no-margg">
	<div class="col-md-10">
	<div class="row">
		<div class="input-field col-md-1">
			{!! Form::number('e_td', null, ['id' => 'e_td', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('e_td', 'Td') !!}
			</div>
			<div class="input-field col-md-2">
				{!! Form::number('e_control', null, ['id' => 'e_control', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('e_control', 'Control') !!}
			</div>
			<div class="input-field col-md-2">
				{!! Form::text('e_fecha', null, ['id' => 'e_fecha', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('e_fecha', 'Fecha') !!}
			</div>
			<div class="input-field col-md-2">
				{!! Form::text('e_hora', null, ['id' => 'e_hora', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('e_hora', 'Hora') !!}
		  </div>
			<div class="input-field col-md-5 cata-marg-select">
			{!! Form::select('e_entidad', $array_entidades, 0, ['id' => 'e_entidad']) !!}
			{!! Form::label('e_entidad', 'Entidad') !!}
		  </div>
		  <div class="input-field cata-marg-select col-md-6">
			{!! Form::select('e_profesional_medico', $arr_medicos , null, ['id' => 'e_profesional_medico']) !!}
			{!! Form::label('e_profesional_medico', 'Médico Que Realiza Remisión') !!}
		  </div>
		  <div class="input-field col-md-12">
			{!! Form::textarea('subjetivo', null, ['id' => 'subjetivo', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
				{!! Form::label('subjetivo', 'Subjetivo') !!}
		  </div>
		  <div class="input-field col-md-12">
			{!! Form::textarea('objetivo', null, ['id' => 'objetivo', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
				{!! Form::label('objetivo', 'Objetivo') !!}
		  </div>
		  <div class="input-field col-md-12">
			{!! Form::textarea('e_descripcion', null, ['id' => 'e_descripcion', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
				{!! Form::label('e_descripcion', 'Descripción General') !!}
		  </div>
		  <div class="input-field col-md-12">
			{!! Form::textarea('e_observaciones', null, ['id' => 'e_observaciones', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
				{!! Form::label('e_observaciones', 'Observaciones Generales') !!}
		  </div>
		  <div class="input-field col-md-12">
				{!! Form::select('e_intervencion', [
				  0 => 'Medicina General',
				  1 => 'Psiquiatria',
				  2 => 'Psicología',
				  3 => 'Fonoaudiología',
				  4 => 'Trabajo Social',
				  5 => 'Nutricionista',
				  6 => 'Otras Especialdiades',
				  ], 0, ['id' => 'e_intervencion']) !!}
				{!! Form::label('e_intervencion', 'Tipo de Intervención') !!}
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
				<a class="waves-effect waves-light btn blue darken-4 dev-btn-with-icon-20" id="guardar_evolucion">
					<i class="material-icons left">save</i>
					Guardar
				</a><br>
				<!-- Modal Trigger -->
				<a class="waves-effect waves-light btn blue darken-4 modal-trigger dev-btn-with-icon-20" id="consultar_evolucion" href="#modal_evolucion">
					<i class="material-icons">search</i>
					Consultar
				</a>
			</div>
		</div>
  </div>
</div>