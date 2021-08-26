<br>
<div class="row">
    <div class="input-field col s4">
      {!! Form::text('nombre', null, ['id' => 'nombre', 'class' => 'validate']) !!}
      {!! Form::label('nombre', 'Nombre del Profesional') !!}
    </div>
    <div class="input-field col s4">
      {!! Form::number('nit', null, ['id' => 'nit', 'class' => 'validate']) !!}
      {!! Form::label('nit', 'Nit CC Profesional') !!}
    </div>
    <div class="input-field col s4">
      {!! Form::text('direccion', null, ['id' => 'direccion', 'class' => 'validate']) !!}
      {!! Form::label('direccion', 'Dirección') !!}
    </div>
</div>
<div class="row">
    <div class="input-field col s4">
      {!! Form::number('telefono', null, ['id' => 'telefono', 'class' => 'validate']) !!}
      {!! Form::label('telefono', 'Teléfono') !!}
    </div>
    <div class="input-field col s4">
      {!! Form::number('celular', null, ['id' => 'celular', 'class' => 'validate']) !!}
      {!! Form::label('celular', 'Celular') !!}
    </div>
    <div class="input-field col s4">
      {!! Form::text('registro_medico', null, ['id' => 'registro_medico', 'class' => 'validate']) !!}
      {!! Form::label('registro_medico', 'Registro Médico') !!}
    </div>
</div>
<div class="row">
  <div class="input-field col s4">
    {!! Form::select('horario_consulta', [
			'' => '...',
      '10' => '10 min',
      '15' => '15 min',
      '30' => '30 min'
    ], '', ['id' => 'horario_consulta']) !!}
    {!! Form::label('horario_consulta', 'Horario de atención Consulta') !!}
  </div>
  <div class="input-field col s4">
    {!! Form::select('horario_precedimientos', [
			'' => '...',
      '10' => '10 min',
      '15' => '15 min',
      '30' => '30 min'
    ], '', ['id' => 'horario_precedimientos']) !!}
    {!! Form::label('horario_precedimientos', 'Horario Atención de Procedimientos') !!}
  </div>
  <div class="input-field col s4">
    {!! Form::select('horario_cirugias', [
			'' => '...',
      '10' => '10 min',
      '15' => '15 min',
      '30' => '30 min'
		], '', ['id' => 'horario_cirugias']) !!}
    {!! Form::label('horario_cirugias', 'Horario Atención de Cirugías') !!}
  </div>
</div>
<div class="row">
	<div class="input-field col s6 padd-cargo">
		{!! Form::text('cargo', null, ['id' => 'cargo', 'class' => 'validate']) !!}
    {!! Form::label('cargo', 'Cargo') !!}
  </div>
  <div class="input-field col s6">
    {!! Form::select('especialidad', [
			'' => '...',
      '1' => 'Medicina General',
      '2' => 'Psiquiatra',
      '3' => 'Psicologia',
      '4' => 'Fonaudiologia',
      '5' => 'Trabajo Social',
      '6' => 'Nutricionista',
      '7' => 'Otras Especialidades'
		], '', ['id' => 'especialidad']) !!}
    {!! Form::label('especialidad', 'Clasificación especialidad profesional') !!}
  </div>
</div>

<br>

<div class="row text-center" id="ocultar-cuenta" >
  <div class="input-field col-md-12" style="margin: 0px;">
    <p>
      <label>
        <input type="checkbox" class="filled-in" id="cuenta" />
        <span><span id="title_check_cuenta">Crear</span> cuenta de usuario en el sistema</span>
      </label>
    </p>
  </div>
</div>

<div class="col-md-12" id="vista-usuario">
  <div class="row">
    <div class="col-md-12">
      <div class="card-header card-panel blue darken-2">
        <h4 style="margin:0px">Información de acceso</h4>
      </div>
    </div>
  </div>
  <br>

  <div class="row">
    <div class="col-md-12">
      <div class="input-field col s4">
        {!! Form::text('user', null, ['id' => 'user', 'class' => 'validate']) !!}
        {!! Form::label('user', 'Correo electrónico') !!}
      </div>
      <div class="input-field col s4">
        {!! Form::password('pass', ['id' => 'pass', 'class' => 'validate']) !!}
        {!! Form::label('pass', 'Contraseña') !!}
      </div>
      <div class="input-field col s4">
        {!! Form::password('passconfirm', ['id' => 'passconfirm', 'class' => 'validate']) !!}
        {!! Form::label('passconfirm', 'Confirmar Contraseña') !!}
      </div>
    </div>
  </div>
</div>

<br>
<br>
