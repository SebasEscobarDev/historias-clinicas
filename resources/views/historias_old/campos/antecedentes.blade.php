<div class="row">
  <div class="input-field col s6">
    {!! Form::textarea('motivo_consulta', null, ['id' => 'motivo_consulta', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
    {!! Form::label('motivo_consulta', 'Motivo De Consulta') !!}
  </div>
  <div class="input-field col s6">
    {!! Form::textarea('antecedentes_personales', null, ['id' => 'antecedentes_personales', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
    {!! Form::label('antecedentes_personales', 'Antecedentes Personales') !!}
  </div>
</div>
<div class="row">
  <div class="input-field col s6">
    {!! Form::textarea('enfermedad_actual', null, ['id' => 'enfermedad_actual', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
    {!! Form::label('enfermedad_actual', 'Enfermedad Actual') !!}
  </div>
  <div class="input-field col s6">
    {!! Form::textarea('antecedentes_familiares', null, ['id' => 'antecedentes_familiares', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
    {!! Form::label('antecedentes_familiares', 'Antecedentes Familiares') !!}
  </div>
</div>
<div class="row">
  <div class="input-field col s6">
    {!! Form::textarea('antecedentes_alergicos', null, ['id' => 'antecedentes_alergicos', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
    {!! Form::label('antecedentes_alergicos', 'Antecedentes Alergicos') !!}
  </div>
  <div class="input-field col s6">
    {!! Form::textarea('af_enfermedad_mental', null, ['id' => 'af_enfermedad_mental', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
    {!! Form::label('af_enfermedad_mental', 'Antecedentes Familiares Enfermedad Mental') !!}
  </div>
</div>