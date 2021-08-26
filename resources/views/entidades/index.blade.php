@extends('layouts.master')

@section('title', 'Registro de Entidades')

@section('icon', 'group')

@section('content')

	<!-- LISTA DE PROFESIONALES -->

	<input type="hidden" name="txt_EditEntidad" id="txt_EditEntidad">

	@include('entidades.listar')

	<!-- VER PROFESIONAL -->

	@include('entidades.ver')

	<!-- Crear Profesional -->

	@include('entidades.crear')


@endsection

@section('scripts')
	{!!Html::script('js/entidades.js?v=0.0.7')!!}
@endsection
