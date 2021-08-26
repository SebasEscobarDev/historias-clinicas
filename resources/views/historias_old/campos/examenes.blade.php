<h5>Examen físico</h5>
<h5>&nbsp;&nbsp;Signos Vitales:</h5>
<div class="row no-margg">
  <div class="col-md-8">
    <div class="row">
      <div class="input-field col-md-4">
        {!! Form::text('tension_arterial', '', ['id' => 'tension_arterial', 'class' => 'validate']) !!}
        {!! Form::label('tension_arterial', 'Tension Arterial') !!}
      </div>
      <div class="input-field col-md-4">
        {!! Form::text('fc_lxm', '', ['id' => 'fc_lxm', 'class' => 'validate']) !!}
        {!! Form::label('fc_lxm', 'F.C (LxM)') !!}
      </div>
      <div class="input-field col-md-4">
        {!! Form::text('fr_rxm', '', ['id' => 'fr_rxm', 'class' => 'validate']) !!}
        {!! Form::label('fr_rxm', 'F.R (RxM)') !!}
      </div>
      <div class="input-field col-md-3">
        {!! Form::text('temperatura', '', ['id' => 'temperatura', 'class' => 'validate']) !!}
        {!! Form::label('temperatura', 'Temperatura (ºC)') !!}
      </div>
      <div class="input-field col-md-3">
        {!! Form::text('peso', '', ['id' => 'peso', 'class' => 'validate']) !!}
        {!! Form::label('peso', 'Peso (kg):') !!}
      </div>
      <div class="input-field col-md-3">
        {!! Form::text('talla', '', ['id' => 'talla', 'class' => 'validate']) !!}
        {!! Form::label('talla', 'Talla (mts)') !!}
      </div>
      <div class="input-field col-md-3">
        {!! Form::text('imc', '', ['id' => 'imc', 'class' => 'validate']) !!}
        {!! Form::label('imc', 'IMC') !!}
      </div>
      <div class="input-field col-md-12">
        {!! Form::textarea('exploracion_general', null, ['id' => 'exploracion_general', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
        {!! Form::label('exploracion_general', 'Exploracion general examen fisico') !!}
      </div>
      <div class="input-field col-md-12">
        {!! Form::textarea('otros_resultados', null, ['id' => 'otros_resultados', 'rows' => 4, 'cols' => 54, 'style' => 'resize:none', 'class' => 'materialize-textarea']) !!}
        {!! Form::label('otros_resultados', 'Otros Resultados') !!}
      </div>
    </div>
  </div>
  <div class="col-md-5"></div>
</div>