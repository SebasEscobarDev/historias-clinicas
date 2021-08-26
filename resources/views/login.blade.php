<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <link rel="shortcut icon" href="{{{ asset('img/icon.png') }}}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Historias Clinicas</title>

	<!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <!-- Compiled and minified JavaScript -->
  {!!Html::style('css/csSebas.css')!!}

  <style type="text/css">
  	html, body{
			width: 100%;
			height: 100%;
  	}
  	body > .row{
  		height: 100%;
  		margin-bottom: 0px;
  	}
  	body{
  		background-image: url('/img/background.jpg');
  		background-size: 100%;
      background-position-x: -272px;
  	}
  </style>

</head>
<body>
	<div class="row">
    <div class="col s8 left-login">
    	<div class="col s12 bg-img-login">
    		<div class="bottom-text">
    			<div class="col s12">
    				<h4>
    					<i class="material-icons">airline_seat_flat_angled</i>
    					HISTORIA CLINICA
    				</h4>
    				<p>Bienvenido al administrador del sistema.</p>
    			</div>
    		</div>
    	</div>
    </div>
    <div class="col s4 right-login">
    	<div class="frm-log col s12">
        <h6 class="center blue darken-3">Ingresar</h6>

        @include('alerts.errors')

        <form method="POST" action="{{ route('login') }}" class="col s12 form-login">
          @csrf
          <div class="row">
            @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
            @endif
            <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                <input id="email" type="email" class="validate{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('Correo electrónico') }}</label>
            </div>
            <div class="input-field col s12">
                <i class="material-icons prefix">https</i>
                <input id="password" type="password" class="validate{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>
                @if ($errors->has('password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
                </div>
            </div>
            
            <div class="input-field col s12 center">
              <button class="blue darken-3 waves-effect waves-light btn btn-login" type="submit">
                Ingresar
              </button>
            </div>
          </div>
        </form>
    	</div>
    </div>
	</div>

	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
	<!-- Materialize -->
	{!!Html::script('https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js')!!}
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- my Scripts -->
	{!!Html::script('js/jSebas.js')!!}

</body>
</html>
