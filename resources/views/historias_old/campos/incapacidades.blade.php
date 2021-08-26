<!-- id	historia_id	td	incapacidad	fecha	hora	entidad	profesional_medico	clase_incapacidad	tipo_incapacidad	dias	inicio	finalizacion	txt_dias	diagnostico	descripcion -->
<div class="row no-margg">
	<div class="col-md-10">
  	<div class="row">
  		<div class="input-field col-md-1">
  			{!! Form::number('i_td', null, ['id' => 'i_td', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('i_td', 'Td') !!}
			</div>
			<div class="input-field col-md-2">
				{!! Form::number('incapacidad', null, ['id' => 'incapacidad', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('incapacidad', 'Incapacidad') !!}
			</div>
			<div class="input-field col-md-2">
				{!! Form::text('i_fecha', null, ['id' => 'i_fecha', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('i_fecha', 'Fecha') !!}
			</div>
			<div class="input-field col-md-2">
				{!! Form::text('i_hora', null, ['id' => 'i_hora', 'class' => 'validate', 'disabled']) !!}
				{!! Form::label('i_hora', 'Hora') !!}
		  </div>
			<div class="input-field col-md-5 cata-marg-select">
		    {!! Form::select('i_entidad', $array_entidades, 0, ['id' => 'i_entidad']) !!}
		    {!! Form::label('i_entidad', 'Entidad') !!}
		  </div>
		  <div class="input-field cata-marg-select col-md-6">
		    {!! Form::select('i_profesional_medico', $arr_medicos , null, ['id' => 'i_profesional_medico']) !!}
		    {!! Form::label('i_profesional_medico', 'Profesional Médico') !!}
		  </div>
		  <div class="input-field col-md-6 cata-marg-select">
		  	{!! Form::select('clase_incapacidad', [
          0 => '...',
          1 => 'Clase Incapacidad 1',
          2 => 'Clase Incapacidad 2',
          3 => 'Clase Incapacidad 3',
          ], 0, ['id' => 'clase_incapacidad']) !!}
		    {!! Form::label('clase_incapacidad', 'Clase Incapacidad') !!}
		  </div>
		  <div class="input-field col-md-3 cata-marg-select">
		  	{!! Form::select('tipo_incapacidad', [
          0 => '...',
          1 => 'Tipo Incapacidad 1',
          2 => 'Tipo Incapacidad 2',
          3 => 'Tipo Incapacidad 3',
          ], 0, ['id' => 'tipo_incapacidad']) !!}
		    {!! Form::label('tipo_incapacidad', 'Tipo Incapacidad') !!}
		  </div>
		  <div class="input-field col-md-2">
	        {!! Form::text('inicio', null, ['id' => 'inicio', 'class' => 'datepicker']) !!}
	        {!! Form::label('inicio', 'Fecha Inicio') !!}
	    </div>
	    <div class="input-field col-md-3">
	        {!! Form::text('finalizacion', null, ['id' => 'finalizacion', 'class' => 'datepicker']) !!}
	        {!! Form::label('finalizacion', 'Fecha Finalizacion') !!}
	    </div>
	    <div class="input-field col-md-1">
	        {!! Form::text('dias', null, ['id' => 'dias']) !!}
	        {!! Form::label('dias', 'Días') !!}
	    </div>
	    <div class="input-field col-md-3">
	        {!! Form::text('txt_dias', null, ['id' => 'txt_dias']) !!}
	        {!! Form::label('txt_dias', 'Días En Letras') !!}
	    </div>
	    <div class="input-field col-md-12 cata-marg-select">
		    {!! Form::select('i_diagnostico', [
          0 => '...',
          1 => 'Diagnóstico 1',
          2 => 'Diagnóstico 2',
          3 => 'Diagnóstico 3',
          ], 0, ['id' => 'i_diagnostico']) !!}
		    {!! Form::label('i_diagnostico', 'Diagnóstico') !!}
		  </div>
		  <div class="input-field col-md-12">
		  	{!! Form::textarea('i_descripcion', null, ['id' => 'i_descripcion', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
				{!! Form::label('i_descripcion', 'Descripción General') !!}
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
				<a class="waves-effect waves-light btn blue darken-4 dev-btn-with-icon-20" id="guardar_incapacidad">
					<i class="material-icons left">save</i>
					Guardar
				</a><br>
				<!-- Modal Trigger -->
				<a class="waves-effect waves-light btn blue darken-4 modal-trigger dev-btn-with-icon-20" id="consultar_incapacidades" href="#modal_incapacidades">
					<i class="material-icons">search</i>
					Consultar
				</a>
			</div>
		</div>
  </div>
</div>