<div class="col s12 vistas" id="create">

<div class="row text-right btn-register">
    <div class="dev-buttons top-button">
        <a class="waves-effect waves-light btn dev-volver blue darken-4 float-left">
            <i class="material-icons left">chevron_left</i>
            Volver
        </a>
		<a class="blue darken-4 waves-effect waves-light btn modal-trigger float-right tooltipped" data-position="bottom" data-tooltip="Seleccionar Paciente para Historia Médica" href="#modal1">
			Seleccionar Paciente
			<i class="material-icons left">assignment_ind</i>
		</a>
    </div>
</div>

<div class="row justify-content-center list-paciente-inicio">
	<div class="col-md-12 text-center justify-content-center">
		<br>
		<h5 class="sub-title-paper"><i class="material-icons">assignment_ind</i><b>DETALLES DEL PACIENTE</b></h5>
	</div>
	<div class="col-md-12 text-center justify-content-center selected-paciente">
	</div>
	<div class="col-md-12 text-center justify-content-center title-paciente-para-historia">
		<br>
		<br>
		<h5><b><span class="title-historia-up">REGISTRAR</span> HISTORIA DEL PACIENTE</b></h5>
	</div>
</div>

{!! Form::open(['url' => '', 'class' => 'col s12 frm-registro-historias']) !!}
	<div class="col s12">

		@include('historias.campos.form')

		<div class="row justify-content-center">

			<div class="dev-buttons">
				<a class="waves-effect waves-light btn blue darken-4" id="registrar">
					<i class="material-icons left">save</i>
					Guardar
				</a>
				<a class="waves-effect waves-light btn blue darken-4" id="editar">
					<i class="material-icons left">save</i>
					Editar
				</a>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<a class="waves-effect waves-light btn dev-volver blue darken-4">
					<i class="material-icons left">chevron_left</i>
					Volver
				</a>
			</div>
		</div>
	</div>

	<br>
	<br>

{!! Form::close() !!}
</div>