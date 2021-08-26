@extends('layouts.master')

@section('title', 'Registro de Pacientes')

@section('icon', 'group')

@section('content')

	<!-- LISTA DE PROFESIONALES -->

	<input type="hidden" name="txt_EditPaciente" id="txt_EditPaciente">

	@include('pacientes.listar')

	<!-- VER PROFESIONAL -->

	@include('pacientes.ver')

	<!-- Crear Profesional -->

	@include('pacientes.crear')


@endsection

@section('scripts')
	{!!Html::script('js/pacientes.js?v=5.8.9')!!}
@endsection
