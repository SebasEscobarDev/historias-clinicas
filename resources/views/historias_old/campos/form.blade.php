<br>
<div class="row input-padd justify-content-center">
  <div class="input-field col-md-2 dev-style-historia">
		{!! Form::text('historia_id', null, ['id' => 'historia_id', 'class' => 'validate', 'disabled']) !!}
		{!! Form::label('historia_id', 'Historia Nº', ['class' => 'active']) !!}
  </div>
  <div class="input-field col-md-2">
		{!! Form::text('historia-created_at', null, ['id' => 'historia-created_at', 'class' => 'validate', 'disabled']) !!}
		{!! Form::label('historia-created_at', 'Fecha y Hora') !!}
  </div>
  <div class="input-field col-md-2">
		{!! Form::text('f_egreso', null, ['id' => 'f_egreso', 'class' => 'validate', 'disabled']) !!}
		{!! Form::label('f_egreso', 'Fecha Egreso') !!}
  </div>
</div>
<div class="row">
  <div class="input-field col s6 cata-marg-select">
    {!! Form::select('entidad', $array_entidades, 0, ['id' => 'entidad']) !!}
    {!! Form::label('entidad', 'Entidad') !!}
  </div>
  <div class="input-field col s6 cata-marg-select">
    {!! Form::select('profesional_medico', $arr_medicos , null, ['id' => 'profesional_medico']) !!}
    {!! Form::label('profesional_medico', 'Profesional Médico') !!}    
  </div>
</div>
<div class="row">
  <div class="input-field col s4">
		{!! Form::text('acompanante', null, ['id' => 'acompanante', 'class' => 'validate']) !!}
		{!! Form::label('acompanante', 'Acompañante') !!}
  </div>
  <div class="input-field col s4">
		{!! Form::text('parentesco', null, ['id' => 'parentesco', 'class' => 'validate']) !!}
		{!! Form::label('parentesco', 'Parentesco') !!}
  </div>
  <div class="input-field col s4">
		{!! Form::text('telefono', null, ['id' => 'telefono', 'class' => 'validate']) !!}
		{!! Form::label('telefono', 'Telefonos') !!}
  </div>
</div>

<div class="row table-options">
  <div class="col-md-2 blue darken-2 dev-title-tabs">
    <ul class="tabs blue darken-2">
      <li class="tab col-md-12"><a class="active" href="#antecedentes">Antecedentes</a></li><br>
      <li class="tab col-md-12"><a href="#examenes">Otros Examenes</a></li><br>
      <li class="tab col-md-12"><a href="#tratamiento">Dx - Tratamiento</a></li><br>
      <li class="tab col-md-12"><a href="#ordenes">Ordenes Médicas</a></li><br>
      <li class="tab col-md-12"><a href="#paraclinicos">Paraclinicos</a></li><br>
      <li class="tab col-md-12"><a href="#incapacidades">Incapacidades M</a></li><br>
      <li class="tab col-md-12"><a href="#referencias">Referencia - CR</a></li><br>
      <li class="tab col-md-12"><a href="#evoluciones">Evolución</a></li>
    </ul>
  </div>
  <div class="col-md-10">
    <div id="antecedentes" class="col s12">
      <br>
      @include('historias.campos.antecedentes')
    </div>
    <div id="examenes" class="col s12">
      <br>
      @include('historias.campos.examenes')
    </div>
    <div id="tratamiento" class="col s12">
      <br>
      @include('historias.campos.tratamiento')
    </div>
    <div id="ordenes" class="col s12">
      <br>
      @include('historias.campos.ordenes')
    </div>
    <div id="paraclinicos" class="col s12">
      <br>
      @include('historias.campos.paraclinicos')
    </div>
    <div id="incapacidades" class="col s12">
      <br>
      @include('historias.campos.incapacidades')
    </div>
    <div id="referencias" class="col s12">
      <br>
      @include('historias.campos.referencias')
    </div>
    <div id="evoluciones" class="col s12">
      <br>
      @include('historias.campos.evoluciones')
    </div>
  </div>
</div>