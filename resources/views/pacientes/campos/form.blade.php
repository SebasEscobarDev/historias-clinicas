<!-- //	created_at	updated_at -->

<div class="row cata-padd">
    <div class="input-field col s2 cata-marg-select">
        <select name="identificacion_id" id="identificacion_id">
            @foreach( $tipo_documento as $doc )
                <option value="{{ $doc->id }}">{{$doc->name}}</option>                    
            @endforeach
        </select>
        {!! Form::label('identificacion_id', 'Tipo de Documento') !!}
    </div>
    <div class="input-field col s2">
        {!! Form::number('documento', null, ['id' => 'documento', 'class' => 'validate']) !!}
        {!! Form::label('documento', 'Documento') !!}
    </div>
    <div class="input-field col s2">
        {!! Form::text('nombre_1', null, ['id' => 'nombre_1', 'class' => 'validate']) !!}
        {!! Form::label('nombre_1', 'Primer Nombre') !!}
    </div>
    <div class="input-field col s2">
        {!! Form::text('nombre_2', null, ['id' => 'nombre_2', 'class' => 'validate']) !!}
        {!! Form::label('nombre_2', 'Segundo Nombre') !!}
    </div>
    <div class="input-field col s2">
        {!! Form::text('apellido_1', null, ['id' => 'apellido_1', 'class' => 'validate']) !!}
        {!! Form::label('apellido_1', 'Primer Apellido') !!}
    </div>
    <div class="input-field col s2">
        {!! Form::text('apellido_2', null, ['id' => 'apellido_2', 'class' => 'validate']) !!}
        {!! Form::label('apellido_2', 'Segundo Apellido') !!}
    </div>
</div>
<div class="row">
    <div class="input-field col s2">
        {!! Form::text('f_nacimiento', null, ['id' => 'f_nacimiento', 'class' => 'datepicker']) !!}
        {!! Form::label('f_nacimiento', 'Fecha de nacimiento') !!}
    </div>
    <div class="input-field col s2">
        {!! Form::number('edad', null, ['id' => 'edad', 'class' => 'validate']) !!}
        {!! Form::label('edad', 'Edad') !!}
    </div>
    <div class="input-field col s2">
        {!! Form::text('rh', null, ['id' => 'rh', 'class' => 'validate']) !!}
        {!! Form::label('rh', 'Grupo Sanguineo') !!}
    </div>
    <div class="input-field col s2 cata-marg-select">
  	    {!! Form::select('sexo', [
  								'' => '...',
                                'Femenino' => 'Femenino',
                                'Masculino' => 'Masculino',
                                'Indefinido' => 'Indefinido'
                                ], '', ['id' => 'sexo']) !!}
        {!! Form::label('sexo', 'Sexo') !!}
    </div>
    <div class="input-field col s2">
        {!! Form::text('direccion', null, ['id' => 'direccion', 'class' => 'validate']) !!}
        {!! Form::label('direccion', 'Direccion') !!}
    </div>
    <div class="input-field col s2">
        {!! Form::number('telefono', null, ['id' => 'telefono', 'class' => 'validate']) !!}
        {!! Form::label('telefono', 'Teléfono') !!}
    </div>
    <div class="input-field col s2">
        {!! Form::number('celular', null, ['id' => 'celular', 'class' => 'validate']) !!}
        {!! Form::label('celular', 'Celular') !!}
    </div>
</div>
<div class="row">
    <div class="input-field col s4">
        {!! Form::text('correo', null, ['id' => 'correo', 'class' => 'validate']) !!}
        {!! Form::label('correo', 'Correo electrónico') !!}
    </div>
    <div class="input-field col s4 cata-marg-select">
        {!! Form::select('clase', [
                                '' => '...',
                                0 => 'Clase1',
                                1 => 'Clase2',
                                2 => 'Clase3'
                                ], '', ['id' => 'clase']) !!}
        {!! Form::label('clase', 'Clase De Usuario') !!}
    </div>
    <div class="input-field col s4 cata-marg-select">        
        {!! Form::select('afiliacion', [
                                '' => '...',
                                0 => 'Cotizante',
                                1 => 'Beneficiario',
                                2 => 'Adicional'
                                ], '', ['id' => 'afiliacion']) !!}
        {!! Form::label('afiliacion', 'Tipo de Afiliación') !!}
    </div>    
</div>
<div class="row">
	<div class="input-field col s4">
        {!! Form::select('ocupacion', [
                                0 => '1',
                                1 => '2',
                                2 => '3'
                                ], 0, ['id' => 'ocupacion']) !!}
        {!! Form::label('ocupacion', 'Ocupación') !!}
    </div>
    <div class="input-field col s4">
        <select name="depto" id="depto">
            <option value="">...</option>
            @foreach( $departamentos as $depto )
                <option data-depto="{{ $depto->id }}" value="{{ $depto->id }}">{{$depto->nombre}}</option>
            @endforeach
        </select>
        {!! Form::label('depto', 'Departamento') !!}
    </div>
    <div class="input-field col s4 hide" id="div-municipio">
        <div class="hide" id="list-municipios">
            @foreach( $municipios as $municipio )
                <option data-depto="{{ $municipio->departamento_id }}" value="{{ $municipio->id }}">{{$municipio->nombre}}</option>           
            @endforeach
        </div>
        <select name="municipio" id="municipio">
            
        </select>
        {!! Form::label('municipio', 'Municipio') !!}
    </div>
</div>

<br>
<br>
