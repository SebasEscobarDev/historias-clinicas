@extends('layouts.master')

@section('title', 'Historia Clinica')

@section('icon', 'assignment')

@section('content')

	<!-- LISTA DE HISTORIAS -->

	@include('historias.listar')

	<!-- VER HISTORIA -->

	@include('historias.ver')

	<!-- CREAR HISTORIA -->
	@php
    $array_entidades = [];
    $array_entidades[0] = '...';
    foreach ($entidades as $entidad) {
      $array_entidades[$entidad->id] = $entidad->nombre_entidad;
    }

    $array_medicos = [];
    $array_medicos[0] = '...';
    foreach ($medicos as $medico) {
      $arr_medicos[$medico->id] = $medico->nombre;
    }
  @endphp

	@include('historias.crear', compact([
		'array_entidades',
		'array_medicos'
	]))

	<div class="row justify-content-center">
		@include('historias.ventanas-modales-historia')
	</div>

@endsection

@section('scripts')
	{!!Html::script('js/historias.js?v=1.8.0')!!}
	{!!Html::script('js/historia_ordenes.js?v=4.8')!!}
	{!!Html::script('js/historia_paraclinicos.js?v=0.6')!!}
	{!!Html::script('js/historia_incapacidades.js?v=0.9')!!}
	{!!Html::script('js/historia_referencias.js?v=0.8')!!}
	{!!Html::script('js/historia_evoluciones.js?v=0.6')!!}
@endsection