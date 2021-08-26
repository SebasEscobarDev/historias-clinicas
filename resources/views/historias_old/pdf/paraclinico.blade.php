<!DOCTYPE html>
<html>
<head>
	<title>PDF PARACLINICOS</title>
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
	<h1 style="text-align:center;">Fórmula Paraclinico</h1>
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
			<td><b>Paciente:</b> {{ $paraclinico->historia->paciente->nombre_1 }} {{ $paraclinico->historia->paciente->nombre_2 }} {{ $paraclinico->historia->paciente->apellido_1 }} {{ $paraclinico->paciente->apellido_2 }}</td>
			<td><b>Documento:</b> {{ $paraclinico->historia->paciente->documento }}</td>
			<td><b>Fecha:</b> {{ $paraclinico->fecha }}</td>
		</tr>
		<tr>
			<td><b>Entidad:</b> {{ $paraclinico->entidad_id }}</td>
			<td><b>Médico:</b> {{ $paraclinico->medicoEspecialista->nombre }}</td>
		</tr>
	</table>

	<hr>

	<table>
		<tr>
			<td class="title-medi"><h4 class="bordered-title">Díagnosticos</h4></td>
		</tr>
	  <tr>
	    <td> {{ $paraclinico->diagnosticos }} </td>
	  </tr>
	</table>

</body>
</html>