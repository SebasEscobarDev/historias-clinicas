<!DOCTYPE html>
<html>
<head>
	<title>PDF EVOLUCION</title>
	<link rel="shortcut icon" href="{{{ asset('img/icon.png') }}}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<style>
		body{
			font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
		}
		table {
		  font-family: arial, sans-serif;
		  border-collapse: collapse;
		  width: 100%;
		}

		td, th {
		  border: 1px solid #dddddd;
		  text-align: left;
		  padding: 8px;
		}

		th{
		  background-color: #dddddd;
		}
		.pdf-encabezado,
		.pdf-logo,
		.pdf-doctor{
			position: relative;
			display: inline-block;
		}
		.pdf-encabezado{
			width: 100%;
		}
		.pdf-logo{
			width: 29%;
		}
		.pdf-doctor{
			width: 70%;
			vertical-align: top;
		}
		.pdf-doctor h2{
			
		}
		table{
			position: relative;
		}
		.title-medi{
			padding: 0px !important;
		}
		.bordered-title{
			margin: 0px;
			margin-bottom: 0px;
			display: inline-block;
			width: 100%;
			text-align: center;
			position: relative;
			left: 0px;
			top: 0px;
			padding: 7px 0px;
			max-width: 100%;
		}
	</style>
</head>
<body>
	<h1 style="text-align:center;">Fórmula Evolución</h1>
	<hr>
	<div class="pdf-encabezado">
		<div class="pdf-logo">
			<img src="{{ URL::to('/') }}/img/logo-clinica.png">
		</div>
		<div class="pdf-doctor">
			<h2><b>DOCTOR:</b> {{ $evolucion->medicoEspecialista->nombre }} </h2>
		</div>
	</div>
	<hr>

	<table>
		<tr>
			<td><b>Paciente:</b> {{ $evolucion->paciente->nombre_1 }} {{ $evolucion->paciente->nombre_2 }} {{ $evolucion->paciente->apellido_1 }} {{ $evolucion->paciente->apellido_2 }}</td>
			<td><b>Documento:</b> {{ $evolucion->paciente->documento }}</td>
			<td><b>Fecha:</b> {{ $evolucion->fecha }}</td>
		</tr>
		<tr>
			<td><b>Entidad:</b> {{ $evolucion->entidad }}</td>
			<td><b>Médico:</b> {{ $evolucion->medicoEspecialista->nombre }}</td>
		</tr>
	</table>

	<hr>


	<!--
		Array ( [0] => stdClass Object ( [dosis] => 10 ML POR DÍA [cantidad] => 5 [descripcion] => AGUA OXIGENADA [presentacion] => BOTELLA [medicamento_id] => 1 ) [1] => stdClass Object ( [dosis] => 2 pastas cada hora [cantidad] => 10 [descripcion] => IBUPROFENO [presentacion] => TAB [medicamento_id] => 2 ) )
	-->


	<table>
		<tr>
			<th><b>Subjetivo</b></th>
			<th><b>Objetivo</b></th>
			<th><b>Descripcion</b></th>
		</tr>
		<tr>
			<td>{{ $evolucion[0]->subjetivo }}</td>
			<td>{{ $evolucion[0]->objetivo }}</td>
			<td>{{ $evolucion[0]->descripcion }}</td>
		</tr>
		<tr>
			<th><b>Observaciones</b></th>
			<th><b>Intervencion</b></th>
		</tr>
		<tr>
			<td>{{ $evolucion[0]->observaciones }}</td>
			<td>{{ $evolucion[0]->intervencion }}</td>
		</tr>
	</table>

</body>
</html>