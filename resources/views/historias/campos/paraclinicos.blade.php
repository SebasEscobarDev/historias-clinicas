<div class="row no-margg">
	<div class="col-md-10">
  	<div class="row">
  		<div class="input-field col-md-1">
  			{!! Form::number('p_td', null, ['id' => 'p_td', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('p_td', 'Td') !!}
			</div>
			<div class="input-field col-md-2">
				{!! Form::number('solicitud', null, ['id' => 'solicitud', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('solicitud', 'Solicitud Nº') !!}
			</div>
			<div class="input-field col-md-2">
				{!! Form::text('p_fecha', null, ['id' => 'p_fecha', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('p_fecha', 'Fecha') !!}
			</div>
			<div class="input-field col-md-7 cata-marg-select">

		    {!! Form::select('p_entidad', $array_entidades, 0, ['id' => 'p_entidad']) !!}
		    {!! Form::label('p_entidad', 'Entidad') !!}
		  </div>
		  <div class="input-field cata-marg-select col-md-12">
		    {!! Form::select('p_profesional_medico', $arr_medicos , null, ['id' => 'p_profesional_medico']) !!}
		    {!! Form::label('p_profesional_medico', 'Profesional Médico') !!}
		  </div>
		  <div class="input-field col-md-12">
		  	{!! Form::textarea('diagnosticos', null, ['id' => 'diagnosticos', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
				{!! Form::label('diagnosticos', 'Detalles De Examenes: Clinicos Diagnósticos') !!}
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
				<a class="waves-effect waves-light btn blue darken-4 dev-btn-with-icon-20" id="guardar_paraclinico">
					<i class="material-icons left">save</i>
					Guardar
				</a><br>
				<!-- Modal Trigger -->
				<a class="waves-effect waves-light btn blue darken-4 modal-trigger dev-btn-with-icon-20" id="consultar_paraclinicos" href="#modal_paraclinicos">
					<i class="material-icons">search</i>
					Consultar
				</a>
			</div>
		</div>
  </div>
</div>