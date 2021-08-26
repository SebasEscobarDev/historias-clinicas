<h5>Diagnóstico CIE-10</h5>
<div class="row no-margg">
  <div class="col-md-6">
    <div class="row">
      <div class="input-field col-md-12 cata-marg-select">
        {!! Form::select('ingreso', [
	      	0 => '...',
	        1 => 'ingreso 1',
	        2 => 'ingreso 2',
	        3 => 'ingreso 3',
				], '', ['id' => 'ingreso']) !!}
		    {!! Form::label('ingreso', 'Ingreso') !!}
      </div>
      <div class="input-field col-md-12">
        {!! Form::select('egreso', [
	      	0 => '...',
	        1 => 'egreso 1',
	        2 => 'egreso 2',
	        3 => 'egreso 3',
				], '', ['id' => 'egreso']) !!}
		    {!! Form::label('egreso', 'Egreso') !!}
      </div>
      <div class="input-field col-md-12">
        {!! Form::select('relacionado_1', [
	      	0 => '...',
	        1 => 'relacionado_1 1',
	        2 => 'relacionado_1 2',
	        3 => 'relacionado_1 3',
				], '', ['id' => 'relacionado_1']) !!}
		    {!! Form::label('relacionado_1', 'Relacionado 1') !!}
      </div>
      <div class="input-field col-md-12">
        {!! Form::select('relacionado_2', [
	      	0 => '...',
	        1 => 'relacionado_2 1',
	        2 => 'relacionado_2 2',
	        3 => 'relacionado_2 3',
				], '', ['id' => 'relacionado_2']) !!}
		    {!! Form::label('relacionado_2', 'Relacionado 2') !!}
      </div>
      <div class="input-field col-md-12">
				{!! Form::textarea('impresion_dx', null, ['id' => 'impresion_dx', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
				{!! Form::label('impresion_dx', 'Impresion DX') !!}
			</div>
			<div class="input-field col-md-12">
				{!! Form::textarea('notas_privadas', null, ['id' => 'notas_privadas', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
				{!! Form::label('notas_privadas', 'Notas Privadas') !!}
			</div>
    </div>
  </div>
  <div class="col-md-6">
  	<div class="row">
  		<div class="input-field col-md-12">
				{!! Form::textarea('tratamiento', null, ['id' => 'tratamiento', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
				{!! Form::label('tratamiento', 'Tratamiento Conducta') !!}
			</div>
			<div class="input-field col-md-12">
				{!! Form::text('observaciones', null, ['id' => 'observaciones', 'class' => 'validate']) !!}
				{!! Form::label('observaciones', 'Observaciones') !!}
			</div>
		</div>
  </div>
</div>