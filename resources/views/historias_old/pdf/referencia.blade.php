<!DOCTYPE html>
<html>
<head>
	<title>PDF REFERENCIA</title>
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
	<h1 style="text-align:center;">Fórmula Referencia</h1>
	<hr>
	<div class="pdf-encabezado">
		<div class="pdf-logo">
			<img src="{{ URL::to('/') }}/img/logo-clinica.png">
		</div>
		<div class="pdf-doctor">
			<h2><b>DOCTOR:</b> {{ $medico_historia }} </h2>
		</div>
	</div>
	<hr>

	<table>
		<tr>
			<td><b>Paciente:</b> {{ $evolucion->historia->paciente->nombre_1 }} {{ $evolucion->historia->paciente->nombre_2 }} {{ $evolucion->historia->paciente->apellido_1 }} {{ $evolucion->paciente->apellido_2 }}</td>
			<td><b>Documento:</b> {{ $evolucion->historia->paciente->documento }}</td>
			<td><b>Fecha:</b> {{ $evolucion->fecha }}</td>
		</tr>
		<tr>
			<td><b>Entidad:</b> {{ $evolucion->entidad_id }}</td>
			<td><b>Médico:</b> {{ $evolucion->medicoEspecialista->nombre }}</td>
		</tr>
	</table>

	<hr>

	<table>
		<tr>
			<th><b>Especialidad</b></th>
			<th><b>Diagnostico</b></th>
			<th><b>Enfermedad Actual</b></th>
			<th><b>Contra</b></th>
		</tr>
		<tr>
			<td>{{ $referencia->especialidad }}</td>
			<td>{{ $referencia->diagnostico }}</td>
			<td>{{ $referencia->enfermedad_actual }}</td>
			<td>{{ $referencia->contra }}</td>
		</tr>
		<tr>
			<th><b>Hallazgos</b></th>
			<th><b>Examenes</b></th>
			<th><b>Tratamiento</b></th>
		</tr>
		<tr>
			<td>{{ $referencia->hallazgos }}</td>
			<td>{{ $referencia->examenes }}</td>
			<td>{{ $referencia->tratamiento }}</td>
		</tr>
	</table>

</body>
</html>