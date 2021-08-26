
<div class="col s12 vistas" id="create">

<div class="row text-right btn-register">
    <div class="dev-buttons top-button">
        <a class="waves-effect waves-light btn dev-volver blue darken-4">
            <i class="material-icons left">chevron_left</i>
            Volver
        </a>
    </div>
</div>

{!! Form::open(['url' => '', 'class' => 'frm-registro-entidad']) !!}

	@include('entidades.campos.form')

	<div class="row justify-content-center">

		<div class="dev-buttons">
			<a class="waves-effect waves-light btn blue darken-4" id="registrar">
				<i class="material-icons left">person_add</i>
				Agregar
			</a>
			<a class="waves-effect waves-light btn blue darken-4" id="editar">
				<i class="material-icons left">edit</i>
				Editar
			</a>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<a class="waves-effect waves-light btn dev-volver blue darken-4">
				<i class="material-icons left">chevron_left</i>
				Volver
			</a>
		</div>
	</div>

	<br>
	<br>

{!! Form::close() !!}
</div>
