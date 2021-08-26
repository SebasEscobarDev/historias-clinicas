@extends('layouts.master')

@section('title', 'Profesionales en Atención Clínica')

@section('icon', 'group')

@section('content')

	<!-- LISTA DE PROFESIONALES -->
	<input type="hidden" name="txt_EditProfesional" id="txt_EditProfesional">

	@include('medico_especialista.listar')

	<!-- VER PROFESIONAL -->

	@include('medico_especialista.ver')

	<!-- Crear Profesional -->

	@include('medico_especialista.crear')


@endsection

@section('scripts')
	{!!Html::script('js/medicos.js?v=5.4.2')!!}
@endsection
