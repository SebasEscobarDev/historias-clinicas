<!DOCTYPE html>
<html>
<head>
	<title>PDF INCAPACIDAD</title>
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
	<h1 style="text-align:center;">Fórmula Incapacidad</h1>
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
			<td><b>Paciente:</b> {{ $paciente[0]->nombre_1 }} {{ $paciente[0]->nombre_2 }} {{ $paciente[0]->apellido_1 }} {{ $paciente[0]->apellido_2 }}</td>
			<td><b>Documento:</b> {{ $paciente[0]->documento }}</td>
			<td><b>Fecha:</b> {{ $incapacidad[0]->fecha }}</td>
		</tr>
		<tr>
			<td><b>Entidad:</b> {{ $incapacidad[0]->entidad }}</td>
			<td><b>Médico:</b> {{ $incapacidad[0]->profesional_medico }}</td>
		</tr>
	</table>

	<hr>


	<!--
		Array ( [0] => stdClass Object ( [dosis] => 10 ML POR DÍA [cantidad] => 5 [descripcion] => AGUA OXIGENADA [presentacion] => BOTELLA [medicamento_id] => 1 ) [1] => stdClass Object ( [dosis] => 2 pastas cada hora [cantidad] => 10 [descripcion] => IBUPROFENO [presentacion] => TAB [medicamento_id] => 2 ) )
	-->


	<table>
		<tr>
			<th><b>Clase de Incapacidad</b></th>
			<th><b>Tipo de Incapacidad</b></th>
			<th><b>Días</b></th>
			<th><b>Inicio</b></th>
		</tr>
	  <tr>
			<td> {{ $incapacidad[0]->clase_incapacidad }} </td>
			<td> {{ $incapacidad[0]->tipo_incapacidad }} </td>
			<td> {{ $incapacidad[0]->dias }} </td>
			<td> {{ $incapacidad[0]->inicio }} </td>
	  </tr>
	  <tr>
	  	<th><b>Finalización</b></th>
			<th><b>Días en Texto</b></th>
			<th><b>Díagnostico</b></th>
			<th><b>Descripción</b></th>
	  </tr>
	  <tr>
	  	<td> {{ $incapacidad[0]->finalizacion }} </td>
			<td> {{ $incapacidad[0]->txt_dias }} </td>
			<td> {{ $incapacidad[0]->diagnostico }} </td>
			<td> {{ $incapacidad[0]->descripcion }} </td>
	  </tr>
	</table>

</body>
</html>