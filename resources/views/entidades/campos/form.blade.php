<!-- //	created_at	updated_at -->

<div class="row cata-padd">
    <div class="input-field col s2">
        {!! Form::text('nit_entidad', null, ['id' => 'nit_entidad', 'class' => 'validate']) !!}
        {!! Form::label('nit_entidad', 'nit_entidad') !!}
    </div>
    <div class="input-field col s2">
        {!! Form::text('nombre_entidad', null, ['id' => 'nombre_entidad', 'class' => 'validate']) !!}
        {!! Form::label('nombre_entidad', 'nombre_entidad') !!}
    </div>
    <div class="input-field col s2">
        {!! Form::text('direccion', null, ['id' => 'direccion', 'class' => 'validate']) !!}
        {!! Form::label('direccion', 'Direccion') !!}
    </div>
    <div class="input-field col s2">
        {!! Form::text('telefonos', null, ['id' => 'telefonos', 'class' => 'validate']) !!}
        {!! Form::label('telefonos', 'Telefonos') !!}
    </div>
    
</div>
